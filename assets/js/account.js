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

// -------------------------------------------------------------------------------------
// Function: 	LoadNeighborhoodSelect
// Description: Fills a neighborhood <select> from the arctc_neighborhoods table and adds
//              an "Other" option. Choosing "Other" shows the adjacent text box.
// -------------------------------------------------------------------------------------
function LoadNeighborhoodSelect(selectId, otherId, callback) {
  var select = $('#' + selectId);
  var other = $('#' + otherId);

  select.off('change.neighborhood').on('change.neighborhood', function() {
      if (select.val() === '__other__') {
          other.show().focus();
      } else {
          other.hide().val('');
      }
  });

  $.ajax({
    url: 'GENERALFunctions.php',
    type: 'POST',
    data: {method: 'GetNeighborhoodList'},
    dataType: 'json',
    success: function(neighborhoods) {
      select.empty().append($('<option value="">Select</option>'));
      $.each(neighborhoods, function(i, name) {
          select.append($('<option></option>').val(name).text(name));
      });
      select.append($('<option value="__other__">Other</option>'));
      other.hide().val('');
      select.data('neighborhoodsLoaded', true);
      if (select.data('pendingNeighborhood') !== undefined) {
          SetNeighborhoodValue(selectId, otherId, select.data('pendingNeighborhood'));
          select.removeData('pendingNeighborhood');
      }
      if (callback) {
          callback();
      }
    }
  });
}

// -------------------------------------------------------------------------------------
// Function: 	GetNeighborhoodValue
// Description: Returns the neighborhood to save: the selected name, or the text typed
//              into the "Other" box.
// -------------------------------------------------------------------------------------
function GetNeighborhoodValue(selectId, otherId) {
  var value = $('#' + selectId).val();
  if (value === '__other__') {
      return $.trim($('#' + otherId).val());
  }
  return value || '';
}

// -------------------------------------------------------------------------------------
// Function: 	SetNeighborhoodValue
// Description: Selects a saved neighborhood. Matching ignores case and extra spaces.
//              Values not in the list are shown as "Other" with the value in the
//              text box. If the list hasn't loaded yet, the value is applied once it has.
// -------------------------------------------------------------------------------------
function NormalizeNeighborhood(value) {
  return $.trim(value || '').replace(/\s+/g, ' ').toLowerCase();
}

function SetNeighborhoodValue(selectId, otherId, value) {
  var select = $('#' + selectId);
  var other = $('#' + otherId);
  value = $.trim(value || '');

  if (!select.data('neighborhoodsLoaded')) {
      select.data('pendingNeighborhood', value);
      return;
  }

  var key = NormalizeNeighborhood(value);
  var match = select.find('option').filter(function() {
      return this.value !== '' && this.value !== '__other__' && NormalizeNeighborhood(this.value) === key;
  }).first();

  if (value === '') {
      select.val('');
      other.hide().val('');
  } else if (match.length) {
      select.val(match.val());
      other.hide().val('');
  } else {
      select.val('__other__');
      other.show().val(value);
  }
}
