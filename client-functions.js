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
export function GetServerConfiguration() {
    
}