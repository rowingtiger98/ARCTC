<?php
include('session.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ARCTC.ORG</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/arctc.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<?php include 'account_header.php'; ?>
			</header>

		<!-- Subscriber Information Section -->
			<section id="contact" class="wrapper">
				<div class="inner">
					<h2>Subscriber Information</h2>

					<div id="subscriber_filters" class="subscriber_filters">
						<div class="subscriber_filter_item">
							<label for="filter_name">Filter by Name</label>
							<input type="text" id="filter_name" placeholder="Start typing a name..." />
						</div>
						<div class="subscriber_filter_item">
							<label>Export</label>
							<a href="#" id="export_selected_subscribers" class="button special">Export Selected to CSV</a>
						</div>
					</div>

					<div id="subscriber_pagination_top" class="subscriber_pagination_top"></div>

					<div id="subscriber_table_container"></div>
				</div>
			</section>

		<!-- Edit Subscriber Modal -->
			<div id="sub_modal_overlay" class="sub_modal_overlay">
				<div class="sub_modal_box">
					<a href="#" id="sub_modal_close" class="sub_modal_close">&times;</a>
					<h3>Edit Subscriber</h3>

					<label for="modal_name">Name</label>
					<input type="text" id="modal_name" />

					<label for="modal_email">Email</label>
					<input type="text" id="modal_email" />

					<label for="modal_affiliation">Affiliation</label>
					<input type="text" id="modal_affiliation" />

					<label for="modal_neighborhood">Neighborhood</label>
					<div class="neighborhood_group">
						<select id="modal_neighborhood"></select>
						<input type="text" id="modal_neighborhood_other" placeholder="Enter neighborhood" style="display:none;" />
					</div>

					<label for="modal_street_address">Street Address</label>
					<input type="text" id="modal_street_address" />

					<label for="modal_city">City</label>
					<input type="text" id="modal_city" />

					<label for="modal_state">State</label>
					<input type="text" id="modal_state" />

					<label for="modal_zip">Zip</label>
					<input type="text" id="modal_zip" />

					<label for="modal_notes">Notes</label>
					<textarea id="modal_notes" rows="4"></textarea>

					<ul class="actions" style="margin-top: 1.5em;">
						<li><a href="#" id="modal_save" class="button special">Save</a></li>
						<li><a href="#" id="modal_cancel" class="button">Cancel</a></li>
					</ul>
				</div>
			</div>

		<!-- Footer -->
			<?php include 'footer.php'; ?>

		<!-- Scripts -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/mailer.js"></script>
			<script src="assets/js/account.js"></script>

			<script>
			  var SUBSCRIBER_PAGE_SIZE = 50;
			  var subscriberCurrentPage = 1;

			  $( document ).ready(function() {
				LoadSubscriberTable();
				LoadNeighborhoodSelect('modal_neighborhood', 'modal_neighborhood_other');
			  });

			  function LoadSubscriberTable() {
				$.ajax({
				  type: "POST",
				  url: "GENERALFunctions.php",
				  data: {method: 'RenderSubscriberTable'},
				  success: function(data) {
					$("#subscriber_table_container").html(data);
					var elms = document.querySelectorAll('[id="edit_subscriber_link"]');
					for (i = 0; i < elms.length; i++) {
						elms[i].onclick = EditSubscriberRow;
					}
					var deleteElms = document.querySelectorAll('[id="delete_subscriber_link"]');
					for (i = 0; i < deleteElms.length; i++) {
						deleteElms[i].onclick = DeleteSubscriberRow;
					}
					ApplySubscriberFilters();
				  }
				});
			  }

			  function GetFilteredSubscriberRows() {
				return $('#subscriber_table tbody tr').not('.sub_filtered_out');
			  }

			  function BuildSubscriberPaginationList(totalPages) {
				var pagination = $('<ul class="pagination"></ul>');
				for (var p = 1; p <= totalPages; p++) {
					var pageLink = $('<a href="#" class="page">' + p + '</a>').attr('page', p).on('click', function(e) {
						e.preventDefault();
						ShowSubscriberPage(parseInt($(this).attr('page'), 10));
					});
					pagination.append($('<li></li>').append(pageLink));
				}
				return pagination;
			  }

			  function SetupSubscriberPagination() {
				var rows = GetFilteredSubscriberRows();
				var totalPages = Math.max(1, Math.ceil(rows.length / SUBSCRIBER_PAGE_SIZE));

				$('#subscriber_pagination_top').empty();
				$('#subscriber_pagination').remove();
				subscriberCurrentPage = 1;
				ShowSubscriberPage(1);

				if (totalPages > 1) {
					$('#subscriber_pagination_top').append(BuildSubscriberPaginationList(totalPages));

					var bottomPagination = BuildSubscriberPaginationList(totalPages).attr('id', 'subscriber_pagination');
					$('#subscriber_table_container').append(bottomPagination);

					UpdateSubscriberPaginationActiveState();
				}
			  }

			  function ShowSubscriberPage(page) {
				subscriberCurrentPage = page;
				$('#subscriber_table tbody tr').hide();
				var rows = GetFilteredSubscriberRows();
				rows.slice((page - 1) * SUBSCRIBER_PAGE_SIZE, page * SUBSCRIBER_PAGE_SIZE).show();
				UpdateSubscriberPaginationActiveState();
			  }

			  function UpdateSubscriberPaginationActiveState() {
				$('#subscriber_pagination_top .page, #subscriber_pagination .page').each(function() {
					var p = parseInt($(this).attr('page'), 10);
					if (p == subscriberCurrentPage) {
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
					}
				});
			  }

			  function ApplySubscriberFilters() {
				var nameFilter = $('#filter_name').val().toLowerCase();

				$('#subscriber_table tbody tr').each(function() {
					var row = $(this);
					var name = row.find('[data-field="name"]').text().toLowerCase();

					row.toggleClass('sub_filtered_out', name.indexOf(nameFilter) === -1);
				});

				SetupSubscriberPagination();
			  }

			  function SortSubscriberTableByField(field, direction) {
				var tbody = $('#subscriber_table tbody');
				var rows = tbody.find('tr').get();

				rows.sort(function(a, b) {
					var aVal = $(a).find('[data-field="' + field + '"]').text().toLowerCase();
					var bVal = $(b).find('[data-field="' + field + '"]').text().toLowerCase();
					if (aVal < bVal) {
						return (direction === 'asc') ? -1 : 1;
					}
					if (aVal > bVal) {
						return (direction === 'asc') ? 1 : -1;
					}
					return 0;
				});

				$.each(rows, function(i, row) {
					tbody.append(row);
				});

				SetupSubscriberPagination();
			  }

			  var currentEditRow = null;

			  function EditSubscriberRow() {
				event.preventDefault();
				var row = $(this).closest('tr');
				currentEditRow = row;

				$('#modal_name').val(row.find('[data-field="name"]').text());
				$('#modal_email').val(row.find('[data-field="email"] .email_text').text());
				$('#modal_affiliation').val(row.find('[data-field="affiliation"]').text());
				SetNeighborhoodValue('modal_neighborhood', 'modal_neighborhood_other', row.find('[data-field="neighborhood"]').text());
				$('#modal_street_address').val(row.find('[data-field="street_address"]').text());
				$('#modal_city').val(row.find('[data-field="city"]').text());
				$('#modal_state').val(row.find('[data-field="state"]').text());
				$('#modal_zip').val(row.find('[data-field="zip"]').text());
				$('#modal_notes').val(row.find('[data-field="notes"]').text());

				$('#sub_modal_overlay').addClass('active');
			  }

			  function DeleteSubscriberRow() {
				event.preventDefault();
				var row = $(this).closest('tr');
				var subId = $(this).attr('sub_id');
				var name = row.find('[data-field="name"]').text();

				if (!confirm('Delete ' + name + ' from the subscriber list? This cannot be undone.')) {
					return;
				}

				$.ajax({
				  type: "POST",
				  url: "GENERALFunctions.php",
				  data: {method: 'DeleteContactInformation', SUB_ID: subId},
				  dataType: 'json',
				  success: function(data) {
					if (data.success == 1) {
						row.remove();
						SetupSubscriberPagination();
					} else {
						alert('Failed to delete ' + name + ': ' + data.message);
					}
				  }
				});
			  }

			  function CloseSubscriberModal() {
				$('#sub_modal_overlay').removeClass('active');
				currentEditRow = null;
			  }

			  function SaveSubscriberModal() {
				event.preventDefault();
				if (!currentEditRow) {
					return;
				}

				if ($('#modal_neighborhood').val() === '__other__' && GetNeighborhoodValue('modal_neighborhood', 'modal_neighborhood_other') === '') {
					alert('Please enter the neighborhood name for "Other".');
					return;
				}

				var subId = currentEditRow.attr('sub_id');
				var newValues = {
					name: $('#modal_name').val(),
					email: $('#modal_email').val(),
					affiliation: $('#modal_affiliation').val(),
					neighborhood: GetNeighborhoodValue('modal_neighborhood', 'modal_neighborhood_other'),
					street_address: $('#modal_street_address').val(),
					city: $('#modal_city').val(),
					state: $('#modal_state').val(),
					zip: $('#modal_zip').val(),
					notes: $('#modal_notes').val()
				};

				$.ajax({
				  type: "POST",
				  url: "GENERALFunctions.php",
				  data: $.extend({method: 'UpdateSubscriberInformation', SUB_ID: subId}, newValues),
				  dataType: 'json',
				  success: function(data) {
					if (data[0] == 'success') {
						currentEditRow.find('[data-field="name"]').text(newValues.name);
						currentEditRow.find('[data-field="email"] .email_text').text(newValues.email);
						currentEditRow.find('[data-field="affiliation"]').text(newValues.affiliation);
						currentEditRow.find('[data-field="neighborhood"]').text(newValues.neighborhood);
						currentEditRow.find('[data-field="street_address"]').text(newValues.street_address);
						currentEditRow.find('[data-field="city"]').text(newValues.city);
						currentEditRow.find('[data-field="state"]').text(newValues.state);
						currentEditRow.find('[data-field="zip"]').text(newValues.zip);
						currentEditRow.find('[data-field="notes"]').text(newValues.notes);
						CloseSubscriberModal();
					} else {
						alert(data[1]);
					}
				  }
				});
			  }

			  $( document ).ready(function() {
				$('#sub_modal_close').on('click', function(e) {
					e.preventDefault();
					CloseSubscriberModal();
				});
				$('#modal_cancel').on('click', function(e) {
					e.preventDefault();
					CloseSubscriberModal();
				});
				$('#modal_save').on('click', SaveSubscriberModal);

				$('#filter_name').on('input', function() {
					ApplySubscriberFilters();
				});

				$('#subscriber_table_container').on('click', '.sub_sort_arrow', function(e) {
					e.preventDefault();
					var arrow = $(this);
					var field = arrow.attr('data-sort-field');
					arrow.toggleClass('rotated');
					var direction = arrow.hasClass('rotated') ? 'desc' : 'asc';
					SortSubscriberTableByField(field, direction);
				});

				$('#subscriber_table_container').on('click', '.copy_email_link', function(e) {
					e.preventDefault();
					CopyEmailToClipboard($(this));
				});

				$('#subscriber_table_container').on('change', '#select_all_subscribers', function() {
					var checked = $(this).is(':checked');
					GetFilteredSubscriberRows().find('.sub_select_checkbox').prop('checked', checked);
				});

				$('#export_selected_subscribers').on('click', function(e) {
					e.preventDefault();
					var ids = [];
					$('.sub_select_checkbox:checked').each(function() {
						ids.push($(this).val());
					});
					if (ids.length === 0) {
						alert('Please select at least one subscriber to export.');
						return;
					}
					window.open('subscriberscsvexport.php?ids=' + ids.join(','), '_blank');
				});
			  });

			  function CopyEmailToClipboard(link) {
				var emailText = link.closest('td').find('.email_text').text();
				var originalTitle = link.attr('title');

				function showCopiedFeedback() {
					link.text('Copied!');
					setTimeout(function() {
						link.html('&#128203;');
						link.attr('title', originalTitle);
					}, 1200);
				}

				if (navigator.clipboard && navigator.clipboard.writeText) {
					navigator.clipboard.writeText(emailText).then(showCopiedFeedback, function() {
						FallbackCopyEmailText(emailText);
						showCopiedFeedback();
					});
				} else {
					FallbackCopyEmailText(emailText);
					showCopiedFeedback();
				}
			  }

			  function FallbackCopyEmailText(text) {
				var temp = document.createElement('textarea');
				temp.value = text;
				temp.style.position = 'fixed';
				temp.style.opacity = '0';
				document.body.appendChild(temp);
				temp.focus();
				temp.select();
				try {
					document.execCommand('copy');
				} catch (e) {
					/* Clipboard access unavailable - nothing more we can do here. */
				}
				document.body.removeChild(temp);
			  }
			</script>

	</body>
</html>
