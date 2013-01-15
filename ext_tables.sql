#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_aomamebootstrap_direction int(11) DEFAULT '0' NOT NULL,
	tx_aomamebootstrap_alert int(11) DEFAULT '0' NOT NULL,
	tx_aomamebootstrap_well int(11) DEFAULT '0' NOT NULL,
	tx_aomamebootstrap_span int(11) DEFAULT '0' NOT NULL,
	tx_aomamebootstrap_visibility int(11) DEFAULT '0' NOT NULL,
	tx_aomamebootstrap_muted tinyint(3) DEFAULT '0' NOT NULL
	tx_aomamebootstrap_clear tinyint(3) DEFAULT '0' NOT NULL
	tx_aomamebootstrap_closebutton tinyint(3) DEFAULT '0' NOT NULL
);