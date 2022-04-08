/**
 * PSPA. Enable ajax no-loading.
 *
 * To enable no-loading SPA for the application, add this js file
 * in any of the asset bundles.
 */

/**
 * Update entire DOM from ajax data.
 * @param DOM
 */
function changeDOM(DOM)
{
    document.open();
    document.write(DOM);
    document.close();
}

/**
 * Update URL on ajax SPA submit.
 * @param URL
 */
function updateURL(URL)
{
    window.history.pushState(null, null, URL);
}

/**
 * Trigger all clicks and check if a link is clicked.
 * Send ajax to targeted page.
 */
document.body.addEventListener('click', function (e) {
    if (e.target.tagName === 'A') {
        e.preventDefault();

        let link = e.target.getAttribute('href');

        // Get content
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            changeDOM(this.responseText);
            updateURL(window.location.origin + link);
        }
        xhttp.open("POST", link);
        xhttp.send();
    }
}, true)