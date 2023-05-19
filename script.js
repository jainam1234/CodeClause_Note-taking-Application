// Function to fetch and display notes
function fetchAndDisplayNotes() {
    // Send an AJAX request to get_notes.php
    $.ajax({
      url: 'get_notes.php',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        // Clear the notes container
        $('#notes-container').empty();
  
        // Check if any notes are available
        if (response.length > 0) {
          // Iterate through the notes
          response.forEach(function (note) {
            // Create a new note element
            var noteElement = '<div class="note">' +
                              '<h2>' + note.title + '</h2>' +
                              '<p>' + note.content + '</p>' +
                              '<span class="timestamp">Created at: ' + note.created_at + '</span>' +
                              '</div>';
  
            // Append the note element to the notes container
            $('#notes-container').append(noteElement);
          });
        } else {
          // No notes found
          $('#notes-container').html('<p>No notes found.</p>');
        }
      },
      error: function () {
        // Display an error message
        $('#notes-container').html('<p>Error fetching notes.</p>');
      }
    });
  }
  $(document).ready(function () {
    // Load the notes when the page loads
    loadNotes();
  
    // Event listener for the "Add Note" form submission
    $('#add-note-form').submit(function (event) {
      event.preventDefault();
  
      // Get the note title and content
      var noteTitle = $('#note-title').val();
      var noteContent = $('#note-content').val();
  
      // Send an AJAX request to add_note.php
      $.ajax({
        url: 'add_note.php',
        type: 'POST',
        dataType: 'json',
        data: { title: noteTitle, content: noteContent },
        success: function () {
          // Clear the form inputs
          $('#note-title').val('');
          $('#note-content').val('');
  
          // Reload the notes
          loadNotes();
        },
        error: function () {
          // Display an error message
          alert('Error adding note.');
        }
      });
    });
  
    // Event listener for the "Delete Note" button
    $(document).on('click', '.delete-note-button', function () {
      var noteId = $(this).data('note-id');
  
      // Send an AJAX request to delete_note.php
      $.ajax({
        url: 'delete_note.php',
        type: 'POST',
        dataType: 'json',
        data: { noteId: noteId },
        success: function () {
          // Reload the notes
          loadNotes();
        },
        error: function () {
          // Display an error message
          alert('Error deleting note.');
        }
      });
    });
  
    // Event listener for the "Update Note" button
    $(document).on('click', '.update-note-button', function () {
      var noteId = $(this).data('note-id');
      var updatedContent = $(this).siblings('.note-content-input').val();
  
      // Send an AJAX request to update_note.php
      $.ajax({
        url: 'update_note.php',
        type: 'POST',
        dataType: 'json',
        data: { noteId: noteId, updatedContent: updatedContent },
        success: function () {
          // Reload the notes
          loadNotes();
        },
        error: function () {
          // Display an error message
          alert('Error updating note.');
        }
      });
    });
  
    // Function to load the notes from the database
    function loadNotes() {
      $.ajax({
        url: 'get_notes.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          // Clear the notes container
          $('#notes-container').empty();
  
          if (response.length > 0) {
            // Iterate through the notes and create note elements
            for (var i = 0; i < response.length; i++) {
              var note = response[i];
  
              // Create a note element and append it to the notes container
              var noteElement = `
                <div class="note">
                  <h3>${note.title}</h3>
                  <p>${note.content}</p>
                  <p class="note-date">Created: ${note.created_at} | Updated: ${note.updated_at}</p>
                  <input type="text" class="note-content-input" value="${note.content}">
                  <button class="update-note-button" data-note-id="${note.id}">Update</button>
                  <button class="delete-note-button" data-note-id="${note.id}">Delete</button>
                </div>
              `;
              $('#notes-container').append(noteElement);
            }
          } else {
            // Display a message when no notes are found
            $('#notes-container').html('<p>No notes found.</p>');
          }
        },
        error: function () {
          // Display an error message
          $('#notes-container').html('<p>Error loading notes.</p>');
        }
      });
    }
  });
  
  
  
  
  // Fetch and display notes on page load
  fetchAndDisplayNotes();
  