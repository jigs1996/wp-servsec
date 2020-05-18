<div class="wrap">
	<div class="svs-tophead">
		<h2>Request Information</h2>
		<div class="svs-status">Good</div>
	</div>
	<div class="svs-body">
		<div class="svs-head">
			<h2>Important Headers</h2>
		</div>
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
	<!-- Response raw data -->
	<div class="svs-body">
		<div class="svs-head">
			<h2>Server Response Header Raw Data</h2>
		</div>
		<div class="svs-accordian-section">
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span><b>Header</b></span>
					<span><b>Value</b></span>
				</div>
			</div>
			<?php foreach($headers as $key => $value): ?>
				
				<?php $head_name = !empty($key)?ucfirst(str_replace('-', ' ', $key)):'Response'; ?>
				
				<div class="svs-accordian-wrapper">
					<div class="svs-accordian-title">
						<span><?= $head_name ?></span>
						<span><?= !empty($headers[$key])?$headers[$key]:'' ?></span>
					</div>
				</div>
			
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Crtificate Information -->
	<div class="svs-body">
		<div class="svs-head">
			<h2>Certificate Information</h2>
		</div>
		<?php if( !empty($ssl_info) ): ?>
		<div class="svs-accordian-section">
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Organization</span>
					<span><?= $ssl_info['subject']['organization'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Common Name</span>
					<span><?= $ssl_info['subject']['name'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Alternative Names</span><span><?= $ssl_info['subject']['alternative_name'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Issuer</span><span><a href="<?= $ssl_info['issuer']['link'] ?>"><?= $ssl_info['issuer']['organization'] ?></a></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Issuer common name</span><span><?= $ssl_info['issuer']['common_name'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Valid From</span><span><?= $ssl_info['valid_from'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Valid To</span><span><?= $ssl_info['valid_to'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Key Type/Size</span><span><?= $ssl_info['key_type'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Signature Algorithm</span><span><?= $ssl_info['sign_algo'] ?></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>CRl</span><span><?= !empty($ssl_info['cri'])?implode('<br>', $ssl_info['cri']):'' ?></span>
				</div>
			</div>
			<!-- <div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>OCSP</span><span></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>OCSP Must-Staple</span><span></span>
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>Supports OCSP Stapling</span><span></span>
				</div>
			</div> -->
		</div>
		<?php endif; ?>
	</div>
	<div class="svs-footer"></div>
</div>