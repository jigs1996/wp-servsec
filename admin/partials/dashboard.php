<div class="wrap">
	<div class="svs-tophead">
		<h2>Request Information</h2>
		<div class="svs-status">Good</div>
	</div>
	<div class="svs-body">
		<div class="svs-accordian-section">
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>X-Frame-Options</span>
					<?php $xfo = !empty($results['x-frame-options'])?'Active':'Not Active'; ?>
					<span class="status-<?= strtolower($xfo) ?>"><?= $xfo ?></span>
				</div>
				<div class="svs-accordian-description">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
			<div class="svs-accordian-wrapper">
				<div class="svs-accordian-title">
					<span>X-Content-Type-Options</span>
					<?php $xfo = !empty($results['x-content-type-options'])?'Active':'Not Active'; ?>
					<span class="status-<?= str_replace(' ', '-', strtolower($xfo)) ?>"><?= $xfo ?></span>
				</div>
				<div class="svs-accordian-description">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
		</div>
	</div>
	<div class="svs-footer"></div>
</div>