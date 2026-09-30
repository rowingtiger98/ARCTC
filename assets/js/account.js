// -------------------------------------------------------------------------------------
// Function: 	Download_Subscriber_CSV
// Description: This function downloads the current subscriber information as a CSV file.
// -------------------------------------------------------------------------------------
function Download_Subscriber_CSV() {
    console.log('download CSV file');
    $.ajax({
      url: 'GENERALFunctions.php',
      type: 'POST',
      data: {method: 'DownloadSubscriberCSV'},
      success: function(data) {
        console.log(data);
        let csvContent = "data:text/csv;charset=utf-8," + data
        
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "ARCTC_Subscribers.csv");
        document.body.appendChild(link); // Required for FF
        
        link.click();					  
      }
    });
  }

// -------------------------------------------------------------------------------------
// Function: 	Download_Subscriber_CSV
// Description: This function downloads the current subscriber information as a CSV file.
// -------------------------------------------------------------------------------------
function Download_Incidents_CSV() {
    console.log('download Incidentd CSV file');
    $.ajax({
      url: 'INCIDENTFunctions.php',
      type: 'POST',
      data: {method: 'DownloadIncidentCSV'},
      success: function(data) {
        console.log(data);
        let csvContent = "data:text/csv;charset=utf-8," + data
        
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "ARCTC_Incidents.csv");
        document.body.appendChild(link); // Required for FF
        
        link.click();					  
      }
    });
  }
