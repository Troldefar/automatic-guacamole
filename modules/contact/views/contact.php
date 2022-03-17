<?= $pageObj->title; ?>
<form mehod="post" action="index.php">
	<input type="hidden" value="submitContactForm" name="action" />
	<input type="hidden" value="contact" name="section" />
	<input type="text" placeholder="text" />
	<input type="submit" value="send" />
</form>