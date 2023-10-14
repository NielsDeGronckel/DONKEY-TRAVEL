// Variable to keep track of the currently edited cell
var currentEditingCell = null;

// Function to cancel editing
function cancelEdit(rowId, fieldName) {
    if (currentEditingCell !== null) {
        // if (currentEditingCell.rowId !== rowId && currentEditingCell.fieldName !== fieldName) {
            // The "Cancel" button was clicked for the currently edited cell
            var cell = document.getElementById('cell-' + rowId + '-' + fieldName);
            cell.innerHTML = currentEditingCell.originalText;
            currentEditingCell = null; // Clear the currentEditingCell
            console.log("Cancelling editing cell ");

        // }
    }
}

function cancelEditButton(rowId, fieldName) {
    if (currentEditingCell.rowId === rowId && currentEditingCell.fieldName === fieldName) {
        // The "Cancel" button was clicked for the currently edited cell
        var cell = document.getElementById('cell-' + rowId + '-' + fieldName);
        cell.innerHTML = currentEditingCell.originalText;
        currentEditingCell = null; // Clear the currentEditingCell
        console.log("Cancelling with edit button ");

    }
}

// Function to edit a cell
function editCell(rowId, fieldName, tableName, tableId) {
    if (currentEditingCell !== null) {
        if (currentEditingCell.rowId === rowId && currentEditingCell.fieldName === fieldName) {
            // The cell is already being edited, so do nothing
            return;
        } else {
            // Cancel the previous edit if a different cell is being edited
            cancelEdit(currentEditingCell.rowId, currentEditingCell.fieldName);
        }
    }
    console.log("Trying to edit fieldName: " + fieldName + " which has the id name: " + tableId);

    // Get the current cell element
    var cell = document.getElementById('cell-' + rowId + '-' + fieldName);

    // Store the original cell content
    currentEditingCell = {
        rowId: rowId,
        fieldName: fieldName,
        originalText: cell.innerHTML.trim(),
    };

    // Create an input field and set its attributes
    var inputField = document.createElement('input');
    inputField.type = 'text';
    inputField.value = currentEditingCell.originalText; // Set the initial value from the cell
    inputField.className = 'cellInputField';

    // Create a Submit button
    var submitButton = document.createElement('button');
    submitButton.type = 'button';
    submitButton.onclick = function() {
        submitUpdateCell(rowId, fieldName, tableName, tableId);
    };
    submitButton.innerHTML = 'Submit';
    submitButton.className = 'cellSubmitButton';
    // Create a Cancel button
    var cancelButton = document.createElement('button');
    cancelButton.type = 'button';
    cancelButton.onclick = function(event) {
        event.stopPropagation(); // Stop the event from propagating
        cancelEditButton(rowId, fieldName);
    };
    cancelButton.innerHTML = '<i class="bx bx-x"></i>';
    cancelButton.className = 'cellCancelButton';

    // Clear the cell and append the input field, Submit, and Cancel buttons
    cell.innerHTML = '';
    cell.appendChild(inputField);
    cell.appendChild(submitButton);
    cell.appendChild(cancelButton);

        // Add event listener for the "Enter" key to submit
        inputField.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                submitUpdateCell(rowId, fieldName, tableName, tableId);
            }
        });
    
        // Add event listener for the "Esc" key to cancel
        inputField.addEventListener('keyup', function(event) {
            if (event.key === 'Escape') {
                cancelEditButton(rowId, fieldName);
            }
        });
}

// Function to submit the updated cell content to the server
function submitUpdateCell(rowId, fieldName, tableName, tableId) {
    // Get the updated text from the input field
    var inputField = document.getElementById('cell-' + rowId + '-' + fieldName).querySelector('input');
    var updatedText = inputField.value;

    // Create a FormData object to send the data as a form
    var formData = new FormData();
    formData.append('rowId', rowId);
    formData.append('fieldName', fieldName);
    formData.append('tableName', tableName);
    formData.append('updatedText', updatedText);
    formData.append('tableId', tableId);

    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'adminUpdate.php', true);

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // The request was successful, and the server responded with data
            console.log('rowId: ' + rowId);
            console.log('fieldName: ' + fieldName);
            console.log('tableName: ' + tableName);
            console.log('updatedText: ' + updatedText);
            console.log('tableId: ' + tableId);
            console.log(xhr.responseText); // You can handle the response here
            //reaload page to get the changes from database
            location.reload();
        }
    };

    // Send the FormData object to the server
    xhr.send(formData);
}
