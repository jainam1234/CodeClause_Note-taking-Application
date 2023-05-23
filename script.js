
function fetchAndDisplayNotes() {
    
    $.ajax({
      url: 'get_notes.php',
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        
        $('#notes-container').empty();
  
        
        if (response.length > 0) {
          
          response.forEach(function (note) {
            
            var noteElement = '<div class="note">' +
                              '<h2>' + note.title + '</h2>' +
                              '<p>' + note.content + '</p>' +
                              '<span class="timestamp">Created at: ' + note.created_at + '</span>' +
                              '</div>';
  
            
            $('#notes-container').append(noteElement);
          });
        } else {
          
          $('#notes-container').html('<p>No notes found.</p>');
        }
      },
      error: function () {
        
        $('#notes-container').html('<p>Error fetching notes.</p>');
      }
    });
  }
  $(document).ready(function () {
    
    loadNotes();
  
    
    $('#add-note-form').submit(function (event) {
      event.preventDefault();
  
      
      var noteTitle = $('#note-title').val();
      var noteContent = $('#note-content').val();
  
      
      $.ajax({
        url: 'add_note.php',
        type: 'POST',
        dataType: 'json',
        data: { title: noteTitle, content: noteContent },
        success: function () {
          
          $('#note-title').val('');
          $('#note-content').val('');
  
          
          loadNotes();
        },
        error: function () {
          
          alert('Error adding note.');
        }
      });
    });
  
    
    $(document).on('click', '.delete-note-button', function () {
      var noteId = $(this).data('note-id');
  
      
      $.ajax({
        url: 'delete_note.php',
        type: 'POST',
        dataType: 'json',
        data: { noteId: noteId },
        success: function () {
          
          loadNotes();
        },
        error: function () {
          
          alert('Error deleting note.');
        }
      });
    });
  
    
    $(document).on('click', '.update-note-button', function () {
      var noteId = $(this).data('note-id');
      var updatedContent = $(this).siblings('.note-content-input').val();
  
      
      $.ajax({
        url: 'update_note.php',
        type: 'POST',
        dataType: 'json',
        data: { noteId: noteId, updatedContent: updatedContent },
        success: function () {
          
          loadNotes();
        },
        error: function () {
          
          alert('Error updating note.');
        }
      });
    });
  
    
    function loadNotes() {
      $.ajax({
        url: 'get_notes.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          
          $('#notes-container').empty();
  
          if (response.length > 0) {
            
            for (var i = 0; i < response.length; i++) {
              var note = response[i];
  
              
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
            
            $('#notes-container').html('<p>No notes found.</p>');
          }
        },
        error: function () {
          
          $('#notes-container').html('<p>Error loading notes.</p>');
        }
      });
    }
  });
  
  
  
  
  
  fetchAndDisplayNotes();
  