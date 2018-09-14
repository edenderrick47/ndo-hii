<?php
include('header.php');
$listcategories=$catObj-> getCategoryList();
$listproducts=$prodObj-> getproductList();
$listoptions=$optObj-> getOptionsList();
$listcoupons=$couponObj-> getCouponList();
$listcurrencies=$curObj-> getCurrencyList();
$listtemplates=$tempObj-> getTemplateList();
$listorders=$prodObj-> getOrderList();
?>

        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Dashboard</h1>

                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-primary">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                <i class="fa fa-sitemap fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listcategories)?></div>

                                    

                                </div>

                            </div>

                        </div>

                        <a href="categorylist.php">

                            <div class="panel-footer">

                                <span class="pull-left">Categories</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-green">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                    <i class="fa fa-briefcase fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listproducts)?></div>

                                   

                                </div>

                            </div>

                        </div>

                        <a href="productlist.php">

                            <div class="panel-footer">

                                <span class="pull-left">Products</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-yellow">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                    <i class="fa fa-check-square-o fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listoptions)?></div>

                                </div>

                            </div>

                        </div>

                        <a href="optionlist.php">

                            <div class="panel-footer">

                                <span class="pull-left">Options</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-red">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                    <i class="fa fa-list-alt fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listcoupons)?></div>

                                </div>

                            </div>

                        </div>

                        <a href="couponlist.php">

                            <div class="panel-footer">

                                <span class="pull-left">Coupons</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>

                

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-grey">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                    <i class="fa fa-money fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listcurrencies)?></div>

                                </div>

                            </div>

                        </div>

                        <a href="currencylist.php">

                            <div class="panel-footer">

                                <span class="pull-left">Currency</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>

                

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-blue">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                    <i class="fa fa-envelope-o fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listtemplates)?></div>

                                </div>

                            </div>

                        </div>

                        <a href="templatelist.php">

                            <div class="panel-footer">

                                <span class="pull-left">Mail Templates</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>
                

                <div class="col-lg-3 col-md-6">

                    <div class="panel panel-dgreen">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-3">

                                    <i class="fa fa-sort-amount-asc fa-5x"></i>

                                </div>

                                <div class="col-xs-9 text-right">

                                    <div class="huge"><?=count($listorders)?></div>

                                </div>

                            </div>

                        </div>

                        <a href="orders.php">

                            <div class="panel-footer">

                                <span class="pull-left">Orders</span>

                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                <div class="clearfix"></div>

                            </div>

                        </a>

                    </div>

                </div>

                

            </div>

            

            

            <!-- /.row -->

            <div class="row">

                <div class="col-lg-8">

                    

                    <!-- /.panel -->

                    

                    <!-- /.panel -->

                    

                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-8 -->

                <div class="col-lg-4">

                    

                    <!-- /.panel -->

                    

                    <!-- /.panel -->

                    

                    <!-- /.panel .chat-panel -->

                </div>

                <!-- /.col-lg-4 -->

            </div>

            <!-- /.row -->

        </div>

        <!-- /#page-wrapper -->

</div>

   <?php include('footer.php');?>