CREATE TABLE `prediction` (
  `id` 			int(11) NOT NULL AUTO_INCREMENT,
  `league_id` 	int(11) NOT NULL,
  `user_id` 	varchar(45) NOT NULL,
  `prediction` 	int(11) NOT NULL,
  `p_exact_score` 	varchar(45) DEFAULT NULL,
  `l_exact_score` 	varchar(45) DEFAULT NULL,
  `l_match_result` 	varchar(45) DEFAULT NULL,
  `l_win_team` 		varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
