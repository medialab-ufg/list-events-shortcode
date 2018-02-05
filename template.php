<div>
	<span>TEMPLATE:</span>
	
		<div class="filter">
            <span>Data:</span>
            
            <div class="date--picker">
                <i class="fa fa-calendar"></i>
                <!--
                Fonte do plugin jQuery Bootstrap: https://github.com/dangrossman/bootstrap-daterangepicker
                Diretiva Angular para o plugin: https://github.com/fragaria/angular-daterangepicker
                !important: O template, já um pouco modificado do daterangepicker está na linha 48 de js/lib/daterangpicker.js
                @TODO: Passar o template pra fora, aqui para o hipertexto
                -->
                <input class="form-control date-picker date" ng-model="dateRange"
                       date-range-picker="{
                       format:'DD/MMMM',
                       separator: '  ->  ',
                       locale: {
                           applyLabel: '<?php esc_attr_e('Aplicar', 'cultural'); ?>',
                           cancelLabel: '<?php esc_attr_e('Cancelar', 'cultural'); ?>',
                           fromLabel: '<?php esc_attr_e('De', 'cultural'); ?>',
                           toLabel: '<?php esc_attr_e('Até', 'cultural'); ?>'
                       },
                       applyClass: 'testApplyClass btn-primary btn-xs',
                       cancelClass: 'testCancelClass btn-xs',
                       }"
                       style="padding-left:38px"
                       onfocus="this.blur()"
                       >
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
