<h1>liste de mes series</h1>
<?php if (isset($_GET['insert'])) {
	if($_GET['insert'] == "success"){
		echo '<p style="color:green;">Serie enregistrée</p>';
	}
} ?>
<form action="#" method="POST">
	<input type="text" name="name" placeholder="Nom de la serie">
	<button type="submit">Envoyer</button>
</form>
<hr/>
<ul>
<?php foreach ($data['series'] as $value){ ?>
	<li>
		<?php echo $value['name']; ?>
		<a href="index.php?module=serie&action=index&update_id=<?php echo $value['id']; ?>">update</a> - 
		<a style="color: red;" href="index.php?module=serie&action=index&delete_id=<?php echo $value['id']; ?>">delete</a>
	</li>
<?php } ?>
</ul>

<hr/>

<?php if(isset($_GET['update_id'])){ ?>
	<form action="#" method="POST">
		<input type="text" name="new_name" placeholder="Nom de la serie" value="<?php echo $data['serie_name']; ?>">
		<button type="submit">Envoyer</button>
	</form>
<?php } ?>