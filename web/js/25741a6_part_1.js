/**
 * Affiche une alert Bootstrap success
 * @param {String} message
 * @returns {undefined}
 */
function alertSuccess(message) {
    notify($('.alert-success'), message);
}
/**
 * Affiche une alert Bootstrap serror
 * @param {String} message
 * @returns {undefined}
 */
function alertError(message) {
    notify($('.alertError'), message);
}
/**
 * Affiche une alert Bootstrap warning
 * @param {String} message
 * @returns {undefined}
 */
function alertWarning(message) {

    notify($('.alertWarning'), message);
}
/**
 * Affiche une alert Bootstrap info
 * @param {String} message
 * @returns {undefined}
 */
function alertalertInfo(message) {
    notify($('.alertInfo'), message);
}
function notify(element, message) {
    element.text(message);
    element.fadeTo(2000, 500).slideUp(500, function () {
        element.alert().hide();
    });
}