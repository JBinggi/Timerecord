--
-- Base Table
--
CREATE TABLE `timerecord` (
  `Timerecord_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `timerecord`
  ADD PRIMARY KEY (`Timerecord_ID`);

ALTER TABLE `timerecord`
  MODIFY `Timerecord_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Timerecord\\Controller\\TimerecordController', 'Add', '', '', 0),
('edit', 'OnePlace\\Timerecord\\Controller\\TimerecordController', 'Edit', '', '', 0),
('index', 'OnePlace\\Timerecord\\Controller\\TimerecordController', 'Index', 'Timerecords', '/timerecord', 1),
('list', 'OnePlace\\Timerecord\\Controller\\ApiController', 'List', '', '', 1),
('view', 'OnePlace\\Timerecord\\Controller\\TimerecordController', 'View', '', '', 0),
('dump', 'OnePlace\\Timerecord\\Controller\\ExportController', 'Excel Dump', '', '', 0),
('index', 'OnePlace\\Timerecord\\Controller\\SearchController', 'Search', '', '', 0);

--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`, `entity_class`, `entity_tbl_class`) VALUES
('timerecord-single', 'Timerecord', 'OnePlace\\Timerecord\\Model\\Timerecord', 'OnePlace\\Timerecord\\Model\\TimerecordTable');

--
-- Index List
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES
('timerecord-index', 'timerecord-single', 'Timerecord Index');

--
-- Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES ('timerecord-base', 'timerecord-single', 'Timerecord', 'Base', 'fas fa-cogs', '', '0', '', '');

--
-- Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Timerecord', 'fas fa-save', 'Save Timerecord', '#', 'primary saveForm', '', 'timerecord-single', 'link', '', ''),
(NULL, 'Edit Timerecord', 'fas fa-edit', 'Edit Timerecord', '/timerecord/edit/##ID##', 'primary', '', 'timerecord-view', 'link', '', ''),
(NULL, 'Add Timerecord', 'fas fa-plus', 'Add Timerecord', '/timerecord/add', 'primary', '', 'timerecord-index', 'link', '', ''),
(NULL, 'Export Timerecords', 'fas fa-file-excel', 'Export Timerecords', '/timerecord/export', 'primary', '', 'timerecord-index', 'link', '', ''),
(NULL, 'Find Timerecords', 'fas fa-searh', 'Find Timerecords', '/timerecord/search', 'primary', '', 'timerecord-index', 'link', '', ''),
(NULL, 'Export Timerecords', 'fas fa-file-excel', 'Export Timerecords', '#', 'primary initExcelDump', '', 'timerecord-search', 'link', '', ''),
(NULL, 'New Search', 'fas fa-searh', 'New Search', '/timerecord/search', 'primary', '', 'timerecord-search', 'link', '', '');

--
-- Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Name', 'label', 'timerecord-base', 'timerecord-single', 'col-md-3', '/timerecord/view/##ID##', '', 0, 1, 0, '', '', '');

--
-- Default Widgets
--
INSERT INTO `core_widget` (`Widget_ID`, `widget_name`, `label`, `permission`) VALUES
(NULL, 'timerecord_dailystats', 'Timerecord - Daily Stats', 'index-Timerecord\\Controller\\TimerecordController'),
(NULL, 'timerecord_taginfo', 'Timerecord - Tag Info', 'index-Timerecord\\Controller\\TimerecordController');

--
-- User XP Activity
--
INSERT INTO `user_xp_activity` (`Activity_ID`, `xp_key`, `label`, `xp_base`) VALUES
(NULL, 'timerecord-add', 'Add New Timerecord', '50'),
(NULL, 'timerecord-edit', 'Edit Timerecord', '5'),
(NULL, 'timerecord-export', 'Edit Timerecord', '5');

COMMIT;