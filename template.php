<div>
	<h3><?= $atts['title']; ?></h3>
	<div id="date_listevents" data-url="<?= $url; ?>" class="pull-right" style="">
	    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
	    <span></span> <b class="caret"></b>
    </div>

	<div id="loading" class="spinner" style="display:none;"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>

	<div class="list_spaces">
		<?php foreach ($events as $event): ?>
			<div class="list_events_item">
				<h3><?php echo $event->name; ?></h3>
				<p><?php echo $event->shortDescription; ?></p>

				<ul>
					<?php foreach ($event->occurrences as $occurrence): ?>
						<li style="font-size:0.9em"><i>
							<strong><?php echo $occurrence->space->name; ?></strong>
							<?php echo $occurrence->space->endereco;?>
							<br>
							<?php echo $occurrence->rule->description, ', ', $occurrence->rule->price; ?>
							</i>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
</div>
