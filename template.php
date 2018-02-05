<div>
		<div class="filter">
            <span>Data:</span>

			<div id="date_listevents" data-url="<?= $url; ?>" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
			    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			    <span></span> <b class="caret"></b>
                <!--
                Fonte do plugin jQuery Bootstrap: https://github.com/dangrossman/bootstrap-daterangepicker
                Diretiva Angular para o plugin: https://github.com/fragaria/angular-daterangepicker
                !important: O template, já um pouco modificado do daterangepicker está na linha 48 de js/lib/daterangpicker.js
                @TODO: Passar o template pra fora, aqui para o hipertexto
                -->
            </div>
        </div>




		<div class="list_spaces">
			<?php foreach ($events as $event): ?>
				<div class="list_events_item">
					<small>
						<?php echo $event->id; ?>
					</small>
					<?php echo $event->name; ?>
				</div>
			<?php endforeach; ?>
		</div>

</div>
