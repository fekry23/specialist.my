// ---------------------------- FOR TAG FILTER   ------------------------------- //
//------------------ https://github.com/yairEO/tagify#css-variables ----------------- //
// ------------- https://yaireo.github.io/tagify/#section-different-look -------------//

//checks if the current path is '/find-job' and there are no query parameters in the URL.
if (window.location.pathname === '/find-job' && window.location.search === '') {
    localStorage.clear();
}

import Tagify from '@yaireo/tagify'
// -------------------------------------------------------------------------------------- //
// ---------------------------- FOR CATEGORY TAG FILTER   ------------------------------- //
// -------------------------------------------------------------------------------------- //
var input_category = document.querySelector('input[name="input-category-dropdown"]'),
    // init Tagify script on the above inputs
    category_tagify = new Tagify(input_category, {
        whitelist: ["Accounting & Consulting", "Admin Support", "Customer Service", "Data Science & Analytics",
            "Design & Creative", "Engineering & Architecture", "IT & Networking", "Legal", "Sales & Marketing", "Translation",
            "Web/Mobile & Software Dev", "Writing", "Others"],
        maxTags: 3,
        dropdown: {
            maxItems: 12, // <- mixumum allowed rendered suggestions
            classname: "tags-look-category", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0, // <- show suggestions on focus
            closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
        }
    })
// -------------------------------------------------------------------------------------- //
// ---------------------------- END CATEGORY TAG FILTER   ------------------------------- //
// -------------------------------------------------------------------------------------- //

// -------------------------------------------------------------------------------------- //
// ---------------------------- FOR LOCATION TAG FILTER   ------------------------------- //
// -------------------------------------------------------------------------------------- //
var input_state = document.querySelector('input[name=tags-select-state-mode]'),
    state_tagify = new Tagify(input_state, {
        enforceWhitelist: true,
        mode: "select",
        whitelist: ["Johor", "Kedah", "Kelantan", "Kuala Lumpur", "Labuan", "Melaka", "Negeri Sembilan", "Pahang", "Penang",
            "Perak", "Perlis", "Putrajaya", "Sabah", "Sarawak", "Selangor", "Terengganu", "Others"],
        blacklist: ['foo', 'bar'],
    })
// -------------------------------------------------------------------------------------- //
// ---------------------------- END LOCATION TAG FILTER   ------------------------------- //
// -------------------------------------------------------------------------------------- //

// -------------------------------------------------------------------------------------- //
// --------------------------- FOR EVENT HANDLING FILTER   ------------------------------ //
// -------------------------------------------------------------------------------------- //
// bind events
category_tagify.on('change', onChangeTag)
state_tagify.on('change', onChangeTag)

//When tag changes
function onChangeTag(e) {
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);

    //If there's value in input_category filter
    if (input_category.value) {
        const parsedValue = JSON.parse(input_category.value); //converting a JSON string into a JavaScript object
        const tagValue = Array.from(parsedValue).map(el => el.value.replace('"value":', '')).join(',');
        // 1. It creates an array from the parsed JSON object parsedValue using Array.from().
        // 2. For each element in the array, it extracts the value property by replacing the "value": string with an empty string using el.value.replace('"value":', '').
        // 3. It then joins the resulting values into a comma-separated string using .join(',').
        // 4. The resulting string is stored in the tagValue variable.        

        //If tagValue is not empty
        if (tagValue) {
            url.searchParams.set('category', tagValue); // sets the value of the category parameter in the URL query string
        }

    } else if (!input_category.value) {
        url.searchParams.delete('category'); //removes the "category" parameter from the query string of a URL.
    }

    // Same as previous, but this is for location filter
    if (input_state.value) {
        const parsedValue = JSON.parse(input_state.value);
        const tagValue = Array.from(parsedValue).map(el => el.value.replace('"value":', '')).join(',');

        //If tagValue is not empty
        if (tagValue) {
            url.searchParams.set('state', tagValue);
        }

    } else if (!input_state.value) {
        url.searchParams.delete('state');
    }

    window.history.pushState({}, '', url.toString()); //pushes the current URL with the modified query parameters (if any) to the browser history.
    updateDiv(); //Refresh div named c2-row2
}
// -------------------------------------------------------------------------------------- //
// --------------------------- END EVENT HANDLING FILTER   ------------------------------ //
// -------------------------------------------------------------------------------------- //

// ------------------------------------------------------------------------------------- //
// ----------------------------- FOR CHECKBOX FILTERS  --------------------------------- //
// ------------------------------------------------------------------------------------- //
const checkboxBtns = document.querySelectorAll('input[type="checkbox"]');

checkboxBtns.forEach(checkboxBtn => {
    checkboxBtn.addEventListener('change', function () {
        const selectedType = Array.from(document.querySelectorAll('input[name="type"]:checked')).map(el => el.value).join(',');
        const selectedExperience = Array.from(document.querySelectorAll('input[name="experience"]:checked')).map(el => el.value).join(',');
        const selectedHistory = Array.from(document.querySelectorAll('input[name="history"]:checked')).map(el => el.value).join(',');
        const selectedLength = Array.from(document.querySelectorAll('input[name="length"]:checked')).map(el => el.value).join(',');

        const currentUrl = window.location.href;
        const url = new URL(currentUrl);

        if (selectedType) {
            url.searchParams.set('type', selectedType);
        } else {
            url.searchParams.delete('type');
        }

        if (selectedExperience) {
            url.searchParams.set('experience', selectedExperience);
        } else {
            url.searchParams.delete('experience');
        }

        if (selectedHistory) {
            url.searchParams.set('history', selectedHistory);
        } else {
            url.searchParams.delete('history');
        }

        if (selectedLength) {
            url.searchParams.set('length', selectedLength);
        } else {
            url.searchParams.delete('length');
        }

        window.history.pushState({}, '', url.toString());
        updateDiv();
    });
    updateDiv();
});
// ------------------------------------------------------------------------------------ //
// ----------------------------- END CHECKBOX FILTERS  -------------------------------- //
// ------------------------------------------------------------------------------------ //

// ------------------------------------------------------------------------------------ //
// --------------------------- FOR SEARCH BUTTON EVEN HADNLING  ----------------------- //
// ------------------------------------------------------------------------------------ //
const searchInput = document.querySelector('input[type="search"]');
const searchBtn = document.getElementById('search-btn');

searchBtn.addEventListener('click', function () {
    const searchValue = searchInput.value;
    const url = new URL(window.location.href);

    if (searchValue) {
        url.searchParams.set('keywords', searchValue);
    } else {
        url.searchParams.delete('keywords');
    }

    window.history.pushState({}, '', url.toString());
    updateDiv();
});
// ------------------------------------------------------------------------------------ //
// --------------------------- END SEARCH BUTTON EVEN HADNLING  ----------------------- //
// ------------------------------------------------------------------------------------ //

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! //
// !!!!!!!!!!!!!!!!!!!!!!! REFRESH STILL CONTAINT DATA CODE SECTION !!!!!!!!!!!!!!!!!!! //
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! //
// Get the URL search params
const urlSearchParams = new URLSearchParams(window.location.search);
// -------------------------------------------------------------------------------------------------------- //
// -------------------------- SEARCH INPUT STILL CONTAIN DATA AFTER REFRESH ------------------------------- //
// -------------------------------------------------------------------------------------------------------- //
// Get the value of the "search" parameter in the URL query string
const searchValue = urlSearchParams.get('keywords');
// Set the value of the search input field
searchInput.value = searchValue;
// -------------------------------------------------------------------------------------------------------- //
// ----------------------- END OF SEARCH INPUT STILL CONTAIN DATA AFTER REFRESH --------------------------- //
// -------------------------------------------------------------------------------------------------------- //

// -------------------------------------------------------------------------------------------------------- //
// ------------------------------- TAGIFY STILL CONTAIN DATA AFTER REFRESH  ------------------------------- //
// -------------------------------------------------------------------------------------------------------- //
// Create a Map of parameter names and their corresponding Tagify instances
const tagifyMap = new Map([
    ["category", category_tagify],
    ["state", state_tagify]
]);

// Loop through each parameter in the Map
for (const [param, tagify] of tagifyMap) {
    // Get the parameter values from the URL query string and add them as tags to the Tagify instance
    tagify.addTags(urlSearchParams.getAll(param).join(','));
}
// -------------------------------------------------------------------------------------------------------- //
// ------------------------------- END TAGIFY STILL CONTAIN DATA AFTER REFRESH  --------------------------- //
// -------------------------------------------------------------------------------------------------------- //

// -------------------------------------------------------------------------------------------------------- //
// ----------------------------- CHECKBOX STILL CHECKED EVEN AFTER REFRESH  ------------------------------- //
// -------------------------------------------------------------------------------------------------------- //
// Create a mapping of parameter names to their corresponding selectors
const paramsMap = new Map([
    ["type", "input[name='type']"],
    ["experience", "input[name='experience']"],
    ["history", "input[name='history']"],
    ["length", "input[name='length']"]
]); //ADD CLIENT HISTORY HERE LATER

// Loop through the parameter-selector mapping
for (const [param, selector] of paramsMap) {
    // Get all checkboxes matching the selector
    const checkboxes = document.querySelectorAll(selector);

    // Check the stored checked values in localStorage and set the checkboxes accordingly
    const storedCheckedValues = localStorage.getItem(param);
    if (storedCheckedValues) {
        const checkedValues = storedCheckedValues.split(',');
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkedValues.includes(checkbox.value);
        });
    }

    // Add event listeners to update the stored checked values in localStorage
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const checkedValues = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedValues.push(checkbox.value);
                }
            });
            localStorage.setItem(param, checkedValues.join(','));
        });
    });
}

// -------------------------------------------------------------------------------------------------------- //
// ------------------------ END OF CHECKBOX STILL CHECKED EVEN AFTER REFRESH  ----------------------------- //
// -------------------------------------------------------------------------------------------------------- //
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! //
// !!!!!!!!!!!!!!!!!!!!!! END OF REFRESH STILL CONTAINT DATA CODE SECTION !!!!!!!!!!!!! //
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! //

// This function creates filter buttons for the given parameters
function createFilterButton(params) {
    // Get the current URL parameters
    const buttonParams = new URLSearchParams(window.location.search);
    // Get the container where the buttons will be placed
    const buttonsContainer = document.getElementById('c2-row1-mini');
    // Clear the container
    buttonsContainer.innerHTML = '';

    // Loop through each parameter
    params.forEach(param => {
        // Check if the parameter exists in the URL
        if (buttonParams.has(param)) {
            // Get the parameter values and split them by comma
            const values = buttonParams.get(param).split(',');
            // Loop through each parameter value
            values.forEach(paramValue => {
                // Check if the button already exists for this parameter value
                const existingButton = document.querySelector(`button[data-param="${param}"][data-value="${paramValue}"]`);
                if (!existingButton) {
                    // If the button doesn't exist, create a new button element
                    const button = document.createElement('button');
                    // Set the button text to the parameter value
                    button.textContent = paramValue;
                    // Set the data attributes for the parameter and parameter value
                    button.setAttribute('data-param', param);
                    button.setAttribute('data-value', paramValue);
                    button.classList.add('filter-button'); // add a class to the button

                    // Create a close button for the filter button
                    const closeButton = document.createElement('span');
                    closeButton.innerHTML = '<i class="fas fa-times"></i>';
                    closeButton.classList.add('close');
                    closeButton.addEventListener('click', function () {
                        // When the close button is clicked, remove the parameter from the URL and remove the button
                        removeQueryParamBtn(param, paramValue);
                        button.remove();
                    });
                    // Add the close button to the filter button
                    button.appendChild(closeButton);
                    // Add the filter button to the container
                    buttonsContainer.appendChild(button);
                }
            });
        } else {
            // If the parameter doesn't exist in the URL, remove all filter buttons for this parameter
            const paramButtons = document.querySelectorAll(`button[data-param="${param}"]`);
            paramButtons.forEach(button => button.remove());
        }
    });
}



function removeQueryParamBtn(param, paramValue) {
    // Get the current URL
    const currentUrl = window.location.href;

    // Create a new URL object based on the current URL
    const url = new URL(currentUrl);

    console.log(paramValue);

    // If a parameter value is provided
    if (paramValue) {
        // Get the current values for the parameter and filter out the provided value
        const values = url.searchParams.get(param).split(",");
        const updatedValues = values.filter(value => value !== paramValue);

        // If there are still values for the parameter, update the URL with the new values
        if (updatedValues.length > 0) {
            url.searchParams.set(param, updatedValues.join(","));
        } else { // Otherwise, delete the parameter from the URL
            url.searchParams.delete(param);
        }

    } else { // If no parameter value is provided, delete the parameter from the URL
        url.searchParams.delete(param);
    }

    // Find all checkboxes with the corresponding parameter and value and uncheck them
    const checkboxes = document.querySelectorAll(`input[type="checkbox"][name="${param}"][value="${paramValue}"]`);
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });

    // If the parameter is "category", remove the corresponding tag from the category tagify input
    // If the parameter is "state", remove the corresponding tag from the state tagify input
    if (param === "category") {
        category_tagify.removeTags(paramValue);
    } else if (param === "state") {
        state_tagify.removeTags(paramValue);
    }

    // Update the URL in the browser address bar and reload the appropriate section of the page
    window.history.pushState({}, '', url.toString());
    $("#c2-row2").load(window.location.href + " #c2-row2");
    localStorage.clear(); //remove all data stored in local storage

}

// -------------------------------------------------------------------------------------- //
// ----------------------------- FOR REFRESH DIV PROFILE  ------------------------------- //
// -------------------------------------------------------------------------------------- //
//https://stackoverflow.com/questions/33801650/how-do-i-refresh-a-div-content
function updateDiv() {
    $("#c2-row2").load(window.location.href + " #c2-row2");
    createFilterButton(['keywords', 'category', 'state', 'type', 'experience', 'history', 'length']);
}
// -------------------------------------------------------------------------------------- //
// --------------------------- END FOR REFRESH DIV PROFILE  ----------------------------- //
// -------------------------------------------------------------------------------------- //
