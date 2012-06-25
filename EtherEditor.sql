-- MySQL version of the database schema for the EtherEditor extension.
-- License: GNU GPL v2+
-- Author: Mark Holmquist < mtraceur@member.fsf.org >

-- Pads
CREATE TABLE IF NOT EXISTS ethereditor_pads (
  pad_id                   INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  ep_pad_id                VARCHAR(255)        NOT NULL,
  group_id                 VARCHAR(18)         NOT NULL,
  page_title               VARCHAR(255)        NOT NULL,
  public_pad               TINYINT             NOT NULL default '1'
);

CREATE UNIQUE INDEX ee_ep_pad_id ON ethereditor_pads (ep_pad_id);

-- Contributors
CREATE TABLE IF NOT EXISTS ethereditor_contribs (
  contrib_id               INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  pad_id                   INTEGER             NOT NULL,
  username                 VARCHAR(255)        NOT NULL,
  ep_user_id               VARCHAR(18)         NOT NULL,
  has_contributed          TINYINT             NOT NULL default '0'
);
