<!-- Güncelleme veya ekleme gibi sonuçları gösteren bildirim alanı-->
	<?php if($_SESSION['alert']){?>
			<div class="card mb-4 py-3 border-bottom-<?php echo $_SESSION['type']; ?>">
				<div class="card-body">
				<i class="fas fa-<?php echo $_SESSION['icon']; ?>" > </i>
					<?php echo $_SESSION['alert']; ?>
				</div>
			</div>
			<?php 
				unset($_SESSION['alert']);
				unset($_SESSION['type']);
				unset($_SESSION['icon']);
	} ?>
	 