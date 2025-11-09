<script type="text/javascript" src="<?php echo base_url(); ?>js/ip_setting.js"></script>

<style>
    td {
        background: white;
    }

    table.border th {
        color: #FFF;
        background: #77cc6d;
        border: 1px solid #000;
        padding: 3px 5px;
    }

    table.border th,
    td {
        vertical-align: middle;
    }

    .title_c {
        margin: 0 auto;
        margin-bottom: 1em;
        width: 900px;
        clear: both;
        text-align: right;
    }

    table.con th {
        border-top: none !important;
        border-left: none !important;
        width: 10%;
    }

    table.con td {
        border-right: none !important;
        border-top: none !important;
        width: 90%;
        padding: 3px !important;

    }

    table.con {
        width: 100%;
    }

    .btn {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<p style="border-bottom:2px solid #ccc;"></p>
<div style="width: 1150px; margin: 0 auto; position: relative; clear: both;">
    <div class="title-header">
        <div>
            <form action="<?php echo base_url(); ?>menu_con" name="back_menu" method="post">
                <h1>IP許可一覧</h1>
                <input type="submit" style="float: right; margin: 0 auto; margin-bottom: 10px; " name="menu_back" value="Menu" onclick="backMenu()">
                <?php require(APPPATH . "views/element/csrf_input.php"); ?>
            </form>
        </div>
        <hr>
        </hr>
    </div>
    <!-- CONTENT START -->
    <div id="main-wrapper">
        <div align="center">
            <div class="title_c">
                <a href="<?php echo base_url(); ?>IpSetting/ipSettingRegist">
                    <button class="btn-regist">許可IP登録</button>
                </a>
            </div>
            <div style="clear:both"></div>
            <?php if(!empty($this->session->flashdata('save_message'))):?>
                <div class="panel-body">
                    <?php if($this->session->flashdata('save_success')=='success'):?>
                        <div class="alert alert-success" role="alert">
                            <?= $this->session->flashdata('save_message')?>
                        </div>
                    <?php else:?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('save_message')?>
                        </div>
                    <?php endif;?>
                </div>
            <?php endif;?>
            <table class="border2" width="100%" style="width: 900px; margin: 0 auto;">
                <thead>
                    <tr>
                        <th width="22%" class="min-desktop">名称</th>
                        <th width="22%" class="min-desktop">IPアドレス</th>
                        <th width="21%" class="min-desktop">作成日</th>
                        <th width="21%" class="min-desktop">更新日</th>
                        <th width="14%" class="min-desktop">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($admins)) : ?>
                        <?php foreach ($admins as $admin) : ?>
                            <tr>
                                <td><?= $admin['address_name'] ?></td>
                                <td><?= $admin['ip_address'] ?></td>
                                <td><?= $admin['created'] ?></td>
                                <td><?= $admin['modified'] ?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url(); ?>IpSetting/ipSettingEdit?id=<?= $admin['id'] ?>">
                                        <button class="btn">変更</button>
                                    </a>
                                    <button class="btn btn-del" data-msg="<?= $admin['address_name'] ?>" data-url="<?php echo base_url(); ?>IpSetting/adminDelete?id=<?= $admin['id'] ?>">削除</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table><!-- Check with type_login = 0 or 1 -->

        </div>
    </div>
    </body>

    </html>