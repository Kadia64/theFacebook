export function fetchJSON(filename, callback) {
    fetch(filename)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network error when getting: ' + filename);
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            console.error('There was a problem with fetching the file: ' + error);
        });
}
export function CheckCookiesEnabled(previousPage) {    
    function Enabled() {
        document.cookie = 'testCookie=test; max-age=60; path=/;';
        return document.cookie.indexOf('testCookie') !== -1;
    }
    if (!Enabled()) {
        window.location.href = '../../Pages/EnableCookies.php?prev-page=' + previousPage;
    }    
}