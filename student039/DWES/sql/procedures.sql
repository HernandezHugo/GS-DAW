BEGIN
DECLARE var_qty_on_category, var_capacity, var_qty_categories, var_counter, aux_counter, i, j, var_number_of_days INT;
DECLARE aux_initial_day, aux_final_day DATE;

SET var_number_of_days = DATEDIFF(var_final_date, var_initial_date);
SET j = 1;
SET var_qty_on_category = 0;

TRUNCATE TABLE 039_categories_to_show;

/*qty categories*/
SELECT COUNT(*) INTO var_qty_categories
FROM 039_categories;

WHILE j <= var_qty_categories DO
    
    SET aux_initial_day = var_initial_date;
    SET i = 1;
    SET var_counter = 0;

    /*qty of rooms by category*/
    SELECT COUNT(*) INTO var_qty_on_category
    FROM 039_rooms
    WHERE ID_category = j;

    WHILE i <= var_number_of_days DO

        SET aux_counter = 0;
        SET aux_final_day = ADDDATE(aux_initial_day, i);

        /*find qty of reservations each day*/
        SELECT COUNT(*) INTO aux_counter
        FROM 039_reservations
        WHERE ID_category = j AND (initial_date < aux_final_day AND  final_date > aux_initial_day);

        SET aux_initial_day = ADDDATE(aux_initial_day, i);

        /*store the max qty of reservations*/
        IF var_counter < aux_counter THEN
            SET var_counter = aux_counter;
        END IF;

        SET i = i + 1;

    END WHILE;

    IF (var_qty_on_category > var_counter)  THEN        

        SELECT capacity INTO var_capacity
        FROM 039_rooms
        WHERE ID_category = j;

        INSERT INTO 039_categories_to_show(ID_category, category_name, category_description, capacity, price)
        SELECT ID_category, category_name, category_description, var_capacity, (category_price * var_number_of_days) AS price
        FROM 039_categories
        WHERE ID_category = j;

    END IF;

    SET j = j + 1;

END WHILE;

END



BEGIN
DECLARE var_id_service INT;
DECLARE var_total DECIMAL(10,2);

SELECT ID_service INTO var_id_service 
FROM 039_services
WHERE service_name = var_service_name;

SELECT (service_price * var_qty) INTO var_total
FROM 039_services
WHERE service_name = var_service_name;

INSERT INTO 039_cart (ID_reservation, ID_service, qty, total)
VALUES (var_id_reservation, var_id_service, var_qty, var_total);

END


BEGIN 
DECLARE present INT;

SET present = 0;

SELECT COUNT(*) INTO present
FROM 039_cart
WHERE ID_reservation = var_id_reservation AND ID_service = 0;

SELECT * 
FROM 039_cart
WHERE ID_reservation = var_id_reservation;

IF present = 0 THEN

	INSERT INTO 039_cart(ID_reservation, ID_service, qty, total)
	SELECT ID_reservation, 0, DATEDIFF(`final_date`,`initial_date`), total_price  
	FROM 039_reservations
	WHERE ID_reservation = var_id_reservation;

END IF;

SELECT * 
FROM 039_cart
WHERE ID_reservation = var_id_reservation;

END