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
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<?php include 'account_header.php'; ?>
			</header>

		<!-- Neighborhood Information Section -->
			<section id="contact" class="wrapper">
				<div class="inner">
					<h2>Neighborhood Information</h2>

					<p>This page lists the neighborhoods ARCTC keeps statistics on and how many subscribers live in each one.
						Click a subscriber count, or the magnifying glass next to it, to see those subscribers and download them as a CSV file.
						Use <b>Add Neighborhood</b> to add a new neighborhood, or the pencil icon on a row to edit its name, notes, or whether it is
						in the corridor. Neighborhoods outside the corridor are shown in grey and stay available in the subscriber forms.
					</p>

					<ul class="actions">
						<li><a href="#" id="add_neighborhood_button" class="button special">Add Neighborhood</a></li>
					</ul>

					<div id="neighborhood_table_container"></div>
				</div>
			</section>

		<!-- Add / Edit Neighborhood Modal -->
			<div id="hood_add_overlay" class="sub_modal_overlay">
				<div class="sub_modal_box">
					<a href="#" id="hood_add_close" class="sub_modal_close">&times;</a>
					<h3 id="hood_modal_title">Add Neighborhood</h3>

					<label for="new_hood_name">Neighborhood Name</label>
					<input type="text" id="new_hood_name" />

					<div class="hood_checkbox_row">
						<input type="checkbox" id="new_hood_in_cor" checked />
						<label for="new_hood_in_cor">In the corridor</label>
					</div>

					<label for="new_hood_notes">Notes</label>
					<textarea id="new_hood_notes" rows="3"></textarea>

					<ul class="actions" style="margin-top: 1.5em;">
						<li><a href="#" id="hood_add_save" class="button special">Save</a></li>
						<li><a href="#" id="hood_add_cancel" class="button">Cancel</a></li>
					</ul>
				</div>
			</div>

		<!-- Neighborhood Subscribers Modal -->
			<div id="sub_modal_overlay" class="sub_modal_overlay">
				<div class="sub_modal_box hood_modal_box">
					<a href="#" id="sub_modal_close" class="sub_modal_close">&times;</a>
					<div id="hood_subscribers_container"></div>
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
			<script src="assets/js/account.js"></script>

			<script>
			  function LoadNeighborhoodTable() {
				$.ajax({
				  type: "POST",
				  url: "GENERALFunctions.php",
				  data: {method: 'RenderNeighborhoodTable'},
				  success: function(data) {
					$("#neighborhood_table_container").html(data);
				  }
				});
			  }

			  var editingHoodId = null;

			  function OpenAddNeighborhoodModal(e) {
				e.preventDefault();
				editingHoodId = null;
				$('#hood_modal_title').text('Add Neighborhood');
				$('#new_hood_name').val('');
				$('#new_hood_in_cor').prop('checked', true);
				$('#new_hood_notes').val('');
				$('#hood_add_overlay').addClass('active');
				$('#new_hood_name').focus();
			  }

			  function OpenEditNeighborhoodModal(e) {
				e.preventDefault();
				var row = $(this).closest('tr');
				editingHoodId = row.attr('hood_id');
				$('#hood_modal_title').text('Edit Neighborhood');
				$('#new_hood_name').val(row.find('[data-field="name"]').text());
				$('#new_hood_in_cor').prop('checked', row.attr('in_cor') === '1');
				$('#new_hood_notes').val(row.find('[data-field="notes"]').text());
				$('#hood_add_overlay').addClass('active');
				$('#new_hood_name').focus();
			  }

			  function CloseAddNeighborhoodModal() {
				$('#hood_add_overlay').removeClass('active');
				editingHoodId = null;
			  }

			  function SaveNeighborhood(e) {
				e.preventDefault();
				var name = $.trim($('#new_hood_name').val());
				if (name === '') {
					alert('Please enter a neighborhood name.');
					return;
				}

				var data = {
					method: 'AddNeighborhood',
					name: name,
					in_cor: $('#new_hood_in_cor').is(':checked') ? 1 : 0,
					notes: $('#new_hood_notes').val()
				};
				if (editingHoodId !== null) {
					data.method = 'UpdateNeighborhood';
					data.HOOD_ID = editingHoodId;
				}

				$.ajax({
				  type: "POST",
				  url: "GENERALFunctions.php",
				  data: data,
				  dataType: 'json',
				  success: function(data) {
					if (data[0] == 'success') {
						if (data[1].indexOf('moved to the new name') !== -1) {
							alert(data[1]);
						}
						CloseAddNeighborhoodModal();
						LoadNeighborhoodTable();
					} else {
						alert(data[1]);
					}
				  }
				});
			  }

			  function ViewNeighborhoodSubscribers(e) {
				e.preventDefault();
				$.ajax({
				  type: "POST",
				  url: "GENERALFunctions.php",
				  data: {method: 'RenderNeighborhoodSubscribers', group: $(this).attr('data-group')},
				  success: function(data) {
					$('#hood_subscribers_container').html(data);
					$('#sub_modal_overlay').addClass('active');
				  }
				});
			  }

			  $( document ).ready(function() {
				LoadNeighborhoodTable();

				$('#add_neighborhood_button').on('click', OpenAddNeighborhoodModal);
				$('#hood_add_save').on('click', SaveNeighborhood);
				$('#hood_add_cancel, #hood_add_close').on('click', function(e) {
					e.preventDefault();
					CloseAddNeighborhoodModal();
				});
				$('#new_hood_name').on('keydown', function(e) {
					if (e.key === 'Enter') {
						SaveNeighborhood(e);
					}
				});
				$('#neighborhood_table_container').on('click', '.hood_edit_link', OpenEditNeighborhoodModal);
				$('#neighborhood_table_container').on('click', '.hood_view_subscribers', ViewNeighborhoodSubscribers);

				$('#sub_modal_close').on('click', function(e) {
					e.preventDefault();
					$('#sub_modal_overlay').removeClass('active');
				});
			  });
			</script>

	</body>
</html>
