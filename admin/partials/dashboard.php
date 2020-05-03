<div class="wrap">
	<div class="svs-tophead">
		<h2>Request Information</h2>
		<div class="svs-status">Good</div>
	</div>
	<div class="svs-body">
		<div class="svs-accordian-section">
			<?php foreach($results as $key => $header): ?>
				<div class="svs-accordian-wrapper">
					<div class="svs-accordian-title">
						<span><?= $header['name'] ?></span>

						<?php
							$xfo = !empty($header['is_active']) ? $header['value'] : 'Not Active' ;
							$class = !empty($header['is_active']) ? 'active' : 'not-active'; 
						?>
							
						<span class="status-<?= $class ?>"><?= $xfo ?></span>
					</div>
					<div class="svs-accordian-description">
						<?= $header['description'] ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="svs-footer"></div>
</div>