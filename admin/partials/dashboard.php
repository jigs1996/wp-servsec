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
	<div class="svs-body">
		<div class="svs-accordian-section">
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span><b>Header</b></span>
					<span><b>Value</b></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Cache control</span>
					<span><?= $headers['cache-control'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Connection</span>
					<span><?= $headers['connection'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Content encoding</span>
					<span><?= $headers['content-encoding'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Content length</span>
					<span><?= $headers['content-length'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Content type</span>
					<span><?= $headers['content-type'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Date</span>
					<span><?= $headers['date'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Expires</span>
					<span><?= $headers['expires'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Last modified</span>
					<span><?= $headers['last-modified'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Pragma</span>
					<span><?= $headers['pragma'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Server</span>
					<span><?= $headers['server'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Status</span>
					<span><?= $headers['status'] ?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="svs-footer"></div>
</div>