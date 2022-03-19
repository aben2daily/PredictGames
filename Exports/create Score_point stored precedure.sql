DELIMITER $$
CREATE DEFINER=`prediction`@`localhost` PROCEDURE `Score_Points`(in leagueid varchar(45),in userid varchar(45), in prediction varchar(45), in match_result varchar(45))
BEGIN
	if (prediction = match_result) -- -right prediction
    then
		update league
        set point='3'
        where user_id=userid
        and league_id=leagueid;
        -- Win case
    ElseIf ((prediction > match_result) and((prediction = "3" ) and (match_result = "1"))) then -- p win -m loss
		update league
        set point='0'
        where user_id=userid
        and league_id=leagueid;
	Elseif (prediction > match_result) and((prediction =3) and(match_result = 2)) then -- p win -m draw
		update league
        set point=0
        where user_id=userid
        and league_id=leagueid;	
        -- Loss Case
    Elseif (prediction>match_result) and((prediction=2) and(match_result=3)) then -- p win -m draw
		update league
        set point=2
        where user_id=userid
        and league_id=leagueid;
    Elseif (prediction>match_result) and((prediction=2) and(match_result=3)) then -- p draw -m win
		update league
        set point=2
        where user_id=userid
        and league_id=leagueid;
        -- Draw Case
    Elseif (prediction>match_result) and((prediction=2) and(match_result=1)) then -- p draw -m loss
		update league
        set point=0
        where user_id=userid
        and league_id=leagueid;  
    ElseIf (prediction > match_result) and((prediction= 1) and(match_result= 3)) then -- p loss -m win
		update league
        set point=2
        where user_id=userid
        and league_id=leagueid;
    Elseif (prediction>match_result) and ((prediction= 1) and(match_result =2 )) then -- p loss -m draw
		update league
        set point=0
        where user_id=userid
        and league_id=leagueid;            
    END if; 
    commit;
END$$
DELIMITER ;
