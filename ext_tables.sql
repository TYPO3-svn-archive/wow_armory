#
# Table structure for table 'tx_wowarmory_cache'
#
CREATE TABLE tx_wowarmory_cache (
  sheet VARCHAR(16) NOT NULL,
  parameter VARCHAR(128) NOT NULL,
  data BLOB,
  tstamp TIMESTAMP(8),
  PRIMARY KEY (sheet, parameter)
)
