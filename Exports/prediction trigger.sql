DROP TRIGGER IF EXISTS `prediction`.`prediction_AFTER_UPDATE`;

DELIMITER $$
USE `prediction`$$
CREATE DEFINER = CURRENT_USER TRIGGER `prediction`.`prediction_AFTER_UPDATE` AFTER UPDATE ON `prediction` FOR EACH ROW
BEGIN
	call score_point(new.user_id,new.league_id,new.prediction,new.l_match_result);
END$$
DELIMITER ;