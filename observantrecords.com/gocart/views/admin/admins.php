<?php include('header.php'); ?>
<script type="text/javascript">
function areyousure()
{
	return confirm('Are you sure you want to delete this admin?');
}
</script>

<div class="button_set">
	<a href="<?php echo site_url($this->config->item('admin_folder').'/admin/form'); ?>">Add New Admin</a>
</div>

<table class="gc_table" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th class="gc_cell_left">First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Access</th>
			<th class="gc_cell_right"></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($admins as $admin):?>
		<tr>
			<td><?php echo $admin->firstname; ?></td>
			<td><?php echo $admin->lastname; ?></td>
			<td><a href="mailto:<?php echo $admin->email;?>"><?php echo $admin->email; ?></a></td>
			<td><?php echo $admin->access; ?></td>
			<td class="gc_cell_right list_buttons">
				<?php
				$current_admin	= $this->session->userdata('admin');
				$margin			= 30;
				if ($current_admin['id'] != $admin->id): ?>
				<a href="<?php echo site_url($this->config->item('admin_folder').'/admin/delete/'.$admin->id); ?>" onclick="return areyousure();">Delete</a>
				<?php endif; ?>
				<a href="<?php echo site_url($this->config->item('admin_folder').'/admin/form/'.$admin->id);?>">Edit</a>	
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php include('footer.php'); ?>
