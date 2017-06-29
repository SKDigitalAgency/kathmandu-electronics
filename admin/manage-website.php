<?php ob_start();
session_start();
include_once("../functions.php");
if(!check_login()){
    header("Location: http://www.kathmanduelectronics.com/admin");
    ob_end_flush();
    exit();
}
$_SESSION["selected_page"] = "manage-website";
?>
<?php include_once ("meta-admin.php"); ?>
<body>
<div class="container">
    <?php include_once ("header-admin.php"); ?>
    <main>
        <div class="container">
            <ul class="admin-sub-menu">
                <li id="current_submenu" class="design-section">Design</li>
                <li class="pages-section">Pages</li>
                <li class="phones-section">Phones</li>
                <li class="tablets-section">Tablets</li>
                <li class="laptops-section">Laptops</li>
                <li class="stores-section">Stores</li>
                <li class="best-list-section">Best Lists</li>
                <li class="drafts-section">Drafts</li>
                <li class="published-articles-section">Published Articles</li>
            </ul>
            <div id="sub-menu-design-section">
                <?php if(isset($_POST["save-button"])){set_new_theme();} ?>
                <?php if(isset($_POST["save-edit-button"])){process_edit_theme();} ?>
                <?php if(isset($_POST["save-create-button"])){create_new_theme();} ?>
                <?php if(isset($_POST["upload-css-submit-button"])){upload_file("css_file","css");} ?>
                <?php if(isset($_POST["submit-best-list-button"])){save_best_list();} ?>
                <?php if(isset($_GET["draft"]) && $_GET["action"] == "delete"){delete_draft();} ?>
                <?php if(isset($_GET["published"]) && $_GET["action"] == "delete"){delete_published();} ?>

                <form id="used-theme-form" action="manage-website.php" method="POST">
                    <h2>Used Theme</h2>
                    <input disabled id="save-theme-btn" type="submit" name="save-button" value="Save"/>
                    <p>
                        <label class="flt_left" for="used-theme-name">Used Theme</label>
                        <select disabled id="used-theme-name" name="theme_name_used" value="">
                            <?php get_used_theme_name("option"); ?>
                            <?php get_unused_theme_names("option"); ?>
                        </select>
                        <input id="change-theme-btn" type="button" name="change-button" value="Change"/>
                    </p>
                </form>
                <form id="edit-theme-form" action="manage-website.php" method="POST">
                    <h2>Edit Themes</h2>
                    <input disabled id="save-edit-theme-btn" type="submit" name="save-edit-button" value="Save"/>
                    <p>
                        <label class="flt_left" for="edit-theme-name">Select Theme</label>
                        <select id="edit-theme-name" name="theme_name_edit" value="">
                            <?php get_all_theme_names("option"); ?>
                        </select>
                        <input id="edit-theme-btn" type="button" name="edit-button" value="Edit"/>
                    </p>
                    <div id="edit-theme-section">
                        <p>
                            <label class="flt_left" for="edit-theme-header">Select Header</label>
                            <select id="edit-theme-header" name="theme_header_edit" value="">
                                <?php get_all_css("option","header"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-main-index">Select Main(Index)</label>
                            <select id="edit-theme-main-index" name="theme_main_index_edit" value="">
                                <?php get_all_css("option","main-index"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-main-phones">Select Main(Phones)</label>
                            <select id="edit-theme-main-phones" name="theme_main_phones_edit" value="">
                                <?php get_all_css("option","main-phones"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-main-tablets">Select Main(Tablets)</label>
                            <select id="edit-theme-main-tablets" name="theme_main_tablets_edit" value="">
                                <?php get_all_css("option","main-tablets"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-main-laptops">Select Main(Laptops)</label>
                            <select id="edit-theme-main-laptops" name="theme_main_laptops_edit" value="">
                                <?php get_all_css("option","main-laptops"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-main-filter">Select Main(Filter)</label>
                            <select id="edit-theme-main-filter" name="theme_main_filter_edit" value="">
                                <?php get_all_css("option","main-filter"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-aside">Select Aside</label>
                            <select id="edit-theme-aside" name="theme_aside_edit" value="">
                                <?php get_all_css("option","aside"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="edit-theme-footer">Select Footer</label>
                            <select id="edit-theme-footer" name="theme_footer_edit" value="">
                                <?php get_all_css("option","footer"); ?>
                            </select>
                        </p>
                    </div>
                </form>
                <form id="create-theme-form" action="manage-website.php" method="POST">
                    <h2>Create New Theme</h2>
                    <input disabled id="save-create-theme-btn" type="submit" name="save-create-button" value="Save"/>
                    <p>
                        <label class="flt_left" for="create-theme-name">Enter Theme Name</label>
                        <input id="create-theme-name" type="text" name="theme_name_create" value=""/>
                        <input disabled id="create-theme-btn" type="button" name="create-button" value="Create"/>
                    </p>
                    <div id="create-theme-section">
                        <p>
                            <label class="flt_left" for="create-theme-header">Select Header</label>
                            <select id="create-theme-header" name="theme_header_create" value="">
                                <?php get_all_css("option","header"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="create-theme-body">Select Body</label>
                            <select id="create-theme-body" name="theme_body_create" value="">
                                <?php get_all_css("option","body"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="create-theme-aside">Select Aside</label>
                            <select id="create-theme-aside" name="theme_aside_create" value="">
                                <?php get_all_css("option","aside"); ?>
                            </select>
                        </p>
                        <p>
                            <label class="flt_left" for="create-theme-footer">Select Footer</label>
                            <select id="create-theme-footer" name="theme_footer_create" value="">
                                <?php get_all_css("option","footer"); ?>
                            </select>
                        </p>
                    </div>
                </form>
                <form id="upload-css-file-form" action="manage-website.php" method="POST" enctype="multipart/form-data">
                    <h2>Upload New CSS File</h2>
                    <input type="submit" id="upload-css-file-btn" name="upload-css-submit-button" value="submit"/>
                    <p>
                        <input type="file" name="css_file" value=""/>
                    </p>
                    <p>
                        <label class="flt_left" for="css-associated-component">Associated Component</label>
                        <select id="css-associated-component" name="css_associated_component" value="">
                            <option>Header</option>
                            <option>Main-Index</option>
                            <option>Main-Phones</option>
                            <option>Main-Tablets</option>
                            <option>Main-Laptops</option>
                            <option>Main-Filter</option>
                            <option>Aside</option>
                            <option>Footer</option>
                        </select>
                    </p>
                </form>
            </div>
            <div id="sub-menu-pages-section">
                <h2>Pages</h2>
                <?php show_all_pages(); ?>
            </div>
            <div id="sub-menu-phones-section">
                <h2>Phones</h2>
                <?php show_all_phones(); ?>
            </div>
            <div id="sub-menu-tablets-section">
                <h2>Tablets</h2>
                <?php show_all_tablets(); ?>
            </div>
            <div id="sub-menu-laptops-section">
                <h2>Laptops</h2>
                <?php show_all_laptops(); ?>
            </div>
            <div id="sub-menu-stores-section">
                <h2>Stores</h2>
                <?php show_all_stores(); ?>
            </div>
            <div id="sub-menu-best-list-section">
                <h2>Best List</h2>
                <p>
                    <label class="flt_left" for="best-list-title">List Title</label>
                    <select id="best-list-title" name="list-title">
                        <?php get_best_list_titles(); ?>
                    </select>
                </p>
                    <div id="best-phones-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                        <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Phones"/>
                        <h2>Best Phones</h2>
                        <?php  get_list_items("Best Phones"); ?>
                        </form>
                    </div>
                    <div id="best-budget-phones-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Budget Phones"/>
                        <h2>Best Budget Phones</h2>
                        <?php  get_list_items("Best Budget Phones"); ?>
                        </form>
                    </div>
                    <div id="best-mid-range-phones-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Mid-Range Phones"/>
                        <h2>Best Mid-Range Phones</h2>
                        <?php  get_list_items("Best Mid-Range Phones"); ?>
                        </form>
                    </div>
                    <div id="best-tablets-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Tablets"/>
                        <h2>Best Tablets</h2>
                        <?php  get_list_items("Best Tablets"); ?>
                        </form>
                    </div>
                    <div id="best-budget-tablets-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Budget Tablets"/>
                        <h2>Best Budget Tablets</h2>
                        <?php  get_list_items("Best Budget Tablets"); ?>
                        </form>
                    </div>
                    <div id="best-mid-range-tablets-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Mid-Range Tablets"/>
                        <h2>Best Mid-Range Tablets</h2>
                        <?php  get_list_items("Best Mid-Range Tablets"); ?>
                        </form>
                    </div>
                    <div id="best-laptops-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Laptops"/>
                        <h2>Best Laptops</h2>
                        <?php  get_list_items("Best Laptops"); ?>
                        </form>
                    </div>
                    <div id="best-budget-laptops-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Budget Laptops"/>
                        <h2>Best Budget Laptops</h2>
                        <?php  get_list_items("Best Budget Laptops"); ?>
                        </form>
                    </div>
                    <div id="best-mid-range-laptops-section">
                        <form class="best-list-form" action="manage-website.php" method="POST">
                            <input id="submit-best-list-btn" type="submit" name="submit-best-list-button" value="Submit"/>
                            <input type="hidden" name="list-title" value="Best Mid-Range Laptops"/>
                        <h2>Best Mid-Range Laptops</h2>
                        <?php  get_list_items("Best Mid-Range Laptops"); ?>
                        </form>
                    </div>
                </form>
            </div>
            <div id="sub-menu-drafts-section">
                <h2>Drafts</h2>
                <?php get_drafts(); ?>
            </div>
            <div id="sub-menu-published-articles-section">
                <h2>Published Articles</h2>
                <?php get_published_articles(); ?>
            </div>
        </div>
    </main>
    <?php include_once ("aside-admin.php"); ?>
    <?php include_once ("footer-admin.php"); ?>
</div>
</body>
</html>