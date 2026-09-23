#
# Table structure for the "Feature highlight" IRRE child items
# (icon + title + text rows shown next to the big image in the
# "Features" section)
#
CREATE TABLE tx_sitepackage_domain_model_featureitem (
	parentid int(11) unsigned DEFAULT '0' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	bodytext text,
	image int(11) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for the FAQ IRRE child items
# (question + answer rows)
#
CREATE TABLE tx_sitepackage_domain_model_faqitem (
	parentid int(11) unsigned DEFAULT '0' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	bodytext text,
);

#
# Table structure for the testimonial slider IRRE child items
# (quote + name + role + avatar rows)
#
CREATE TABLE tx_sitepackage_domain_model_testimonialitem (
	parentid int(11) unsigned DEFAULT '0' NOT NULL,
	header varchar(255) DEFAULT '' NOT NULL,
	subheader varchar(255) DEFAULT '' NOT NULL,
	bodytext text,
	image int(11) unsigned DEFAULT '0' NOT NULL,
);

#
# Additional fields on tt_content used by the custom
# Sitepackage content elements (hero / CTA banner button label)
#
CREATE TABLE tt_content (
	tx_sitepackage_button_label varchar(255) DEFAULT '' NOT NULL,
	tx_sitepackage_feature_items int(11) unsigned DEFAULT '0' NOT NULL,
	tx_sitepackage_faq_items int(11) unsigned DEFAULT '0' NOT NULL,
	tx_sitepackage_testimonial_items int(11) unsigned DEFAULT '0' NOT NULL,
);
