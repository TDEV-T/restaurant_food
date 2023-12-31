<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <h3>ประวัติการสั่งซื้อ</h3>
        <?php
            $db_history = new database();


            $db_history->select("restaurant_order", "*");
            while ($fetch_history = $db_history->query->fetch_object()) {
                $id_order = $fetch_history->id_o;
            ?>
        <div class="accordion" id="accordionExample<?= $id_order ?>">
            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne<?= $id_order ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?= "ออร์เดอร์รหัสที่ " . $id_order ?>
                    </button>
                </h2>
                <div id="collapseOne<?= $id_order ?>" class="accordion-collapse collapse " aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample<?= $id_order ?>">
                    <div class="accordion-body">
                        <?php
                            $pricesum = 0;
                            $db_detail = new database();

                            $db_detail->selectjoin("restaurant_detail", "*", "INNER JOIN", "restaurant_menu", "restaurant_detail.id_f = restaurant_menu.id_m", "restaurant_detail.id_o = $id_order");

                            while ($fetch_detail = $db_detail->query->fetch_object()) { 
                                $pricesum +=( $fetch_detail -> price_m * $fetch_detail -> count_d);
                                
                                ?>
                        <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                            <div class="d-flex flex-row"><img class="rounded m-3"
                                    src="../../_system/upload/<?= $fetch_detail->img_m ?>" width="40">
                                <div class="ml-2"><span
                                        class="font-weight-bold d-block"><?= $fetch_detail->name_m ?></span><span
                                        class="spec"><?= "ราคาต่อจาน  " . $fetch_detail->price_m ?></span></div>
                            </div>
                            <div class="d-flex flex-row align-items-center"><span
                                    class="d-block"><?= $fetch_detail->count_d ?> : </span><span
                                    class="d-block ml-5 font-weight-bold">
                                    <?= $fetch_detail->count_d * $fetch_detail->price_m  ?></span><i
                                    class="fa fa-trash-o ml-3 text-black-50"></i></div>
                        </div>
                        <?php  }
                            ?>
                        <div class="row">
                            <div class="col-10">
                                <h4>ราคารวม : <?= $pricesum; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="col-2"></div>
</div>