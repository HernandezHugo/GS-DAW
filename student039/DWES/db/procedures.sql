BEGIN
DECLARE var_qty_on_category, var_qty_categories, var_counter, aux_counter, i, j, var_number_of_days INT;
DECLARE var_price DECIMAL(10,2);
DECLARE aux_initial_day, aux_final_day DATE;

SET var_number_of_days = DATEDIFF(var_final_date, var_initial_date);
SET aux_initial_day = var_initial_date;
SET var_price = 0.0;
SET i = 1;
SET j = 1;
SET var_qty_on_category = 0;

TRUNCATE TABLE 039_categories_to_show;

/*qty categories*/
SELECT COUNT(*) INTO var_qty_categories
FROM 039_categories;

WHILE j <= var_qty_categories DO
    
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
        SELECT category_price INTO var_price
        FROM 039_categories
        WHERE ID_category = j;

        SET var_price = var_price * var_number_of_days;

        INSERT INTO 039_categories_to_show(ID_category, price)
        VALUES(j, var_price);
    END IF;

    SET j = j + 1;

END WHILE;

END