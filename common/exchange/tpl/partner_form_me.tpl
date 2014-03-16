<div class="hide">
    <form id="partner_form_me" class="partner_form">
        <div><input name="price" value="0" type="hidden" /></div>
        <div class="error_block"></div>
        <div class="clearfix">
            <dl>
                <dt class="<?=(empty( $braches_from ) && empty( $braches_to ) ? 'hide' : '')?>">
                    <?=l('partner_service', 'el')?><span class="star">*</span>
                </dt>
                <dd class="<?=(empty( $braches_from ) && empty( $braches_to ) ? 'hide' : '')?>">
                    <div class="<?=(empty( $braches_from ) || empty( $braches_to ) ? 'hide' : '')?>">
                        <label>
                            <input name="service" value="0-0" type="radio" />&nbsp;<?=l('partner_storage1', 'el')?> - <?=l('partner_storage2', 'el')?>
                        </label>
                    </div>
                    <div class="<?=(empty( $braches_from ) ? 'hide' : '')?>">
                        <label>
                            <input name="service" value="0-1" type="radio" />&nbsp;<?=l('partner_storage1', 'el')?> - <?=l('partner_home2', 'el')?>
                        </label>
                    </div>
                    <div class="<?=(empty( $braches_to ) ? 'hide' : '')?>">
                        <label>
                            <input name="service" value="1-0" type="radio" />&nbsp;<?=l('partner_home1', 'el')?> - <?=l('partner_storage2', 'el')?>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="service" value="1-1" type="radio"<?=(empty( $braches_from ) && empty( $braches_to ) ? ' checked="checked"' : '')?> />&nbsp;<?=l('partner_home1', 'el')?> - <?=l('partner_home2', 'el')?>
                        </label>
                    </div>
                </dd>
                <dt>
                    <?=l('partner_insurance', 'el')?><span class="star">*</span>
                </dt>
                <dd>
                    <label>
                        <input class="thin_field" name="insurance" value="0" type="text" />
                        <?=l('grn', 'el')?>
                    </label>
                </dd>
                <dt class="ss1<?=(!empty( $braches_from ) ? ' hide' : '')?>">
                    <?=l('partner_address_from', 'el')?><span class="star">*</span>
                </dt>
                <dd class="ss1<?=(!empty( $braches_from ) ? ' hide' : '')?>">
                    <input name="address_from" value="<?=$record_data['address_load']?>" type="text" />
                </dd>
                <dt class="ss1<?=(!empty( $braches_from ) ? ' hide' : '')?>">
                    <?=l('partner_flat', 'el')?>
                </dt>
                <dd class="ss1<?=(!empty( $braches_from ) ? ' hide' : '')?>">
                    <input class="thin_field2" name="flat_from" value="" type="text" />
                </dd>
                <dt class="ss1<?=(!empty( $braches_from ) ? ' hide' : '')?>">
                    <?=l('partner_pickup_datetime', 'el')?><span class="star">*</span>
                </dt>
                <dd class="ss1<?=(!empty( $braches_from ) ? ' hide' : '')?>">
                    <?=l('partner_date', 'el')?>
                    <input class="thin_field" name="pickup_date" value="<?=date('d.m.Y', time()+24*60*60)?>" type="text" />
                    &nbsp;
                    <?=l('partner_time', 'el')?>
                    <input class="thin_field2" name="pickup_time_from" value="08:00" type="text" /> — <input class="thin_field2" name="pickup_time_to" value="20:00" type="text" />
                </dd>
                <dt class="ss0 hide">
                    <?=l('partner_branch_from', 'el')?><span class="star">*</span>
                </dt>
                <dd class="ss0 hide">
                    <select name="branch_from">
                        <option value="">— <?=l('not_selected', 'el')?> —</option>
                        <option value="" disabled="disabled">———————————————————</option>
                        <? foreach( $braches_from as $b ): ?>
                        <option value="<?=$b['branch_id']?>"><?=$b['address']?></option>
                        <? endforeach; ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>
                    <?=l('partner_paytype', 'el')?><span class="star">*</span>
                </dt>
                <dd>
                    <label>
                        <input name="receiver_pay" value="0" type="radio" />&nbsp;<?=l('partner_sender', 'el')?>
                    </label>
                    <label>
                        <input name="receiver_pay" value="1" type="radio" />&nbsp;<?=l('partner_receiver', 'el')?>
                    </label>
                </dd>
                <dt>
                    <?=l('partner_payformtype', 'el')?><span class="star">*</span>
                </dt>
                <dd>
                    <label>
                        <input name="payform" value="0" type="radio" />&nbsp;<?=l('partner_cash', 'el')?>
                    </label>
                    <label>
                        <input name="payform" value="1" type="radio" />&nbsp;<?=l('partner_cashless', 'el')?>
                    </label>
                </dd>
                <dt>
                    <?=l('partner_receiver_name', 'el')?><span class="star">*</span>
                </dt>
                <dd>
                    <input name="receiver_name" value="" type="text" />
                </dd>
                <dt>
                    <?=l('partner_receiver_phone', 'el')?><span class="star">*</span>
                </dt>
                <dd>
                    <input name="receiver_phone" value="" type="text" />
                </dd>
                <dt class="rs1<?=(!empty( $braches_to ) ? ' hide' : '')?>">
                    <?=l('partner_address_to', 'el')?><span class="star">*</span>
                </dt>
                <dd class="rs1<?=(!empty( $braches_to ) ? ' hide' : '')?>">
                    <input name="address_to" value="<?=$record_data['address_unload']?>" type="text" />
                </dd>
                <dt class="rs1<?=(!empty( $braches_to ) ? ' hide' : '')?>">
                    <?=l('partner_flat', 'el')?>
                </dt>
                <dd class="rs1<?=(!empty( $braches_to ) ? ' hide' : '')?>">
                    <input class="thin_field2" name="flat_to" value="" type="text" />
                </dd>
                <? if( !empty( $braches_to ) ): ?>
                <dt class="rs0 hide">
                    <?=l('partner_branch_to', 'el')?><span class="star">*</span>
                </dt>
                <dd class="rs0 hide">
                    <select name="branch_to">
                        <option value="">— <?=l('not_selected', 'el')?> —</option>
                        <option value="" disabled="disabled">———————————————————</option>
                        <? foreach( $braches_to as $b ): ?>
                            <option value="<?=$b['branch_id']?>"><?=$b['address']?></option>
                        <? endforeach; ?>
                    </select>
                </dd>
                <? else: ?>

                <? endif; ?>
            </dl>
        </div>
        <div class="price_block"><?=l('partner_total_price', 'el')?> <span class="summary_price">—</span></div>
        <div class="price_help_block hide">* <?=l('partner_price_notice', 'el')?></div>
        <div class="center">
            <button onclick="PartnerApi.check_form(<?=$record_data['id']?>, 'me');" class="button button_middle partner_submit" type="button"><?=l('partner_submit', 'el')?></button>
        </div>
    </form>
</div>