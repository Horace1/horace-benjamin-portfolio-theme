// src/app.js

import 'jquery';

const projectList = document.querySelector('[data-projects-list]');

if (projectList) {
    const filterForm = document.querySelector('.projects-filter');
    const typeControl = document.querySelector('[data-project-filter="type"]');
    const technologyControl = document.querySelector('[data-project-filter="technology"]');
    const featureControl = document.querySelector('[data-project-filter="feature"]');
    const sortControl = document.querySelector('[data-project-filter="sort"]');
    const searchControl = document.querySelector('[data-project-filter="search"]');
    const submitControl = filterForm ? filterForm.querySelector('.projects-filter__submit') : null;
    let searchTimer;

    const submitFilters = () => {
        if (!filterForm) {
            return;
        }

        if (typeof filterForm.requestSubmit === 'function') {
            filterForm.requestSubmit();
            return;
        }

        filterForm.submit();
    };

    const submitFiltersAfterSearch = () => {
        window.clearTimeout(searchTimer);
        searchTimer = window.setTimeout(submitFilters, 500);
    };

    const updateMultiSelectLabel = (control, defaultLabel) => {
        if (!control || !control.matches('details')) {
            return;
        }

        const selectedLabels = Array.from(control.querySelectorAll('input[type="checkbox"]:checked')).map((checkbox) => {
            const label = checkbox.closest('label');

            return label ? label.textContent.trim() : checkbox.value;
        });
        const labelTarget = control.querySelector('[data-project-filter-label]');

        if (labelTarget) {
            labelTarget.textContent = selectedLabels.length ? selectedLabels.join(', ') : defaultLabel;
        }
    };

    const updateFilterLabels = () => {
        updateMultiSelectLabel(typeControl, 'All Project Types');
        updateMultiSelectLabel(technologyControl, 'All Technologies');
        updateMultiSelectLabel(featureControl, 'All Features');
    };

    [typeControl, technologyControl, featureControl].forEach((control) => {
        if (!control) {
            return;
        }

        control.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                updateFilterLabels();
                submitFilters();
            });
        });

        control.addEventListener('toggle', () => {
            if (!control.open) {
                return;
            }

            [typeControl, technologyControl, featureControl].forEach((otherControl) => {
                if (otherControl && otherControl !== control) {
                    otherControl.open = false;
                }
            });
        });
    });

    document.addEventListener('click', (event) => {
        [typeControl, technologyControl, featureControl].forEach((control) => {
            if (control && control.open && !control.contains(event.target)) {
                control.open = false;
            }
        });
    });

    updateFilterLabels();

    if (sortControl) {
        sortControl.addEventListener('change', submitFilters);
    }

    if (searchControl) {
        searchControl.addEventListener('input', submitFiltersAfterSearch);
    }

    if (submitControl) {
        submitControl.hidden = true;
    }
}

