-- --------------------------------------------------------
-- Host:                         aa1nhkmguvuq5rd.cjrjmpuiontf.ap-southeast-1.rds.amazonaws.com
-- Server version:               5.6.27-log - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5169
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table ebdb.car_extras: ~4 rows (approximately)
/*!40000 ALTER TABLE `car_extras` DISABLE KEYS */;
INSERT INTO `car_extras` (`id`, `name`, `price`, `count`, `per`, `type`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Baby Seat', 5.00, 0, 'booking', 'multi', 1, '2017-07-04 20:14:52', '2017-07-13 10:05:53'),
	(2, 'Driver', 40.00, 0, 'day', 'single', 1, '2017-07-13 10:05:29', '2017-07-13 10:05:29'),
	(3, 'GPS Navigation', 5.00, 0, 'booking', 'single', 1, '2017-07-13 10:06:38', '2017-07-13 10:06:38'),
	(4, 'Car Steering Lock', 5.00, 0, 'booking', 'single', 1, '2017-07-13 10:08:09', '2017-07-13 10:08:09');
/*!40000 ALTER TABLE `car_extras` ENABLE KEYS */;

-- Dumping data for table ebdb.car_models: ~17 rows (approximately)
/*!40000 ALTER TABLE `car_models` DISABLE KEYS */;
INSERT INTO `car_models` (`id`, `make`, `model`, `description`, `type_id`, `price_per_day`, `price_per_hour`, `limit_mileage`, `extra_mileage`, `total_passengers`, `total_bags`, `total_doors`, `thumb_path`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Mitsubishi', 'Attrage 2016', 'Mitsubishi Attrage', 2, 160.00, 20.00, 0, 0.00, 5, 2, 0, '1502362002.jpg', 1, '2017-07-04 20:14:14', '2017-09-04 07:56:10'),
	(2, 'Perodua', 'Bezza 1.3 Premium X AT', 'The Perodua Bezza was developed with an emphasis on fuel efficiency, and is the company\'s first model to feature stop-start idling and regenerative braking. The Bezza is also the first Perodua to feature Vehicle Stability Control (VSC).', 2, 155.00, 19.50, 0, 0.00, 5, 2, 0, '1499943527.jpg', 1, '2017-07-13 10:58:47', '2017-08-10 11:53:37'),
	(3, 'Proton', 'Saga FLX', '', 2, 155.00, 19.50, 0, 0.00, 5, 2, 0, '1501499080.jpg', 1, '2017-07-31 11:04:40', '2017-08-10 11:54:03'),
	(4, 'Honda', 'City 1.5 A', '', 5, 60.00, 8.00, 0, 0.00, 5, 2, 0, '1501499817.jpg', 1, '2017-07-31 11:16:57', '2017-08-01 12:11:30'),
	(5, 'Toyota', 'VIOS 1.5 (A)', '', 5, 60.00, 8.00, 0, 0.00, 5, 2, 0, '1501500596.jpg', 1, '2017-07-31 11:29:56', '2017-08-01 12:11:47'),
	(6, 'Nissan', 'Almera 1.5 (A)', '', 5, 60.00, 8.00, 0, 0.00, 5, 2, 0, '1501501007.jpg', 1, '2017-07-31 11:36:47', '2017-08-01 12:12:02'),
	(7, 'Mazda 2', '1.5 (A)', '', 5, 60.00, 8.00, 0, 0.00, 5, 2, 0, '1501501333.jpg', 1, '2017-07-31 11:42:13', '2017-08-01 12:12:29'),
	(8, 'Toyota', 'Altis 1.6 (Auto)', '', 8, 70.00, 9.00, 0, 0.00, 5, 3, 0, '1501590403.jpg', 1, '2017-08-01 12:26:43', '2017-08-02 05:14:23'),
	(9, 'Mazda 3', '1.6 (Auto)', '', 8, 70.00, 9.00, 0, 0.00, 5, 3, 0, '1501590766.jpg', 1, '2017-08-01 12:32:46', '2017-08-02 05:14:48'),
	(10, 'Perodua', 'Alza 1.6 (Auto)', '', 4, 75.00, 9.50, 0, 0.00, 7, 4, 0, '1501642100.jpg', 1, '2017-08-02 02:48:20', '2017-08-02 08:01:13'),
	(11, 'Honda', 'Civic 1.8 (Auto)', '', 8, 85.00, 11.00, 0, 0.00, 5, 3, 0, '1501651162.jpg', 1, '2017-08-02 05:19:22', '2017-08-02 05:19:22'),
	(12, 'Honda', 'Accord 2.0 (Auto)', '', 6, 297.00, 37.50, 0, 0.00, 5, 3, 0, '1501657749.jpg', 1, '2017-08-02 07:09:09', '2017-08-10 11:55:13'),
	(13, 'Toyota', 'Camry 2.0 (Auto)', '', 6, 105.00, 13.50, 0, 0.00, 5, 3, 0, '1501660665.jpg', 1, '2017-08-02 07:57:45', '2017-08-02 08:01:39'),
	(14, 'Nissan', 'Teana 2.0 )Auto)', '', 6, 105.00, 13.50, 0, 0.00, 5, 3, 0, '1501660771.jpg', 1, '2017-08-02 07:59:31', '2017-08-02 07:59:31'),
	(15, 'Toyota', 'Innova MPV 2.0 (Auto)', '', 4, 115.00, 14.50, 0, 0.00, 7, 4, 0, '1501662542.JPG', 1, '2017-08-02 08:29:02', '2017-08-02 08:29:03'),
	(16, 'Hyundai', 'Starex 2.5 MPV (Auto)', '', 7, 130.00, 16.50, 0, 0.00, 11, 5, 0, '1501662891.jpg', 1, '2017-08-02 08:34:51', '2017-08-02 08:34:51'),
	(17, 'BMW', '5 Series 2.0 (Auto)', '', 3, 750.00, 94.00, 0, 0.00, 5, 3, 0, '1501663100.jpg', 1, '2017-08-02 08:38:20', '2017-08-10 12:02:45');
/*!40000 ALTER TABLE `car_models` ENABLE KEYS */;

-- Dumping data for table ebdb.car_model_extras: ~63 rows (approximately)
/*!40000 ALTER TABLE `car_model_extras` DISABLE KEYS */;
INSERT INTO `car_model_extras` (`car_model_id`, `car_extras_id`) VALUES
	(1, 1),
	(2, 1),
	(2, 4),
	(2, 2),
	(2, 3),
	(1, 4),
	(1, 2),
	(1, 3),
	(3, 1),
	(3, 4),
	(3, 2),
	(3, 3),
	(4, 1),
	(4, 4),
	(4, 2),
	(4, 3),
	(5, 1),
	(5, 4),
	(5, 2),
	(5, 3),
	(6, 1),
	(6, 4),
	(6, 2),
	(6, 3),
	(7, 1),
	(7, 4),
	(7, 2),
	(7, 3),
	(8, 1),
	(8, 4),
	(8, 2),
	(8, 3),
	(9, 1),
	(9, 4),
	(9, 2),
	(9, 3),
	(10, 1),
	(10, 4),
	(10, 2),
	(10, 3),
	(11, 1),
	(11, 4),
	(11, 2),
	(11, 3),
	(12, 1),
	(12, 4),
	(12, 2),
	(12, 3),
	(13, 1),
	(13, 4),
	(13, 2),
	(13, 3),
	(14, 1),
	(14, 4),
	(14, 2),
	(14, 3),
	(15, 1),
	(15, 4),
	(15, 2),
	(15, 3),
	(16, 1),
	(16, 4),
	(16, 2),
	(16, 3),
	(17, 1),
	(17, 4),
	(17, 2),
	(17, 3);
/*!40000 ALTER TABLE `car_model_extras` ENABLE KEYS */;

-- Dumping data for table ebdb.car_model_prices: ~2 rows (approximately)
/*!40000 ALTER TABLE `car_model_prices` DISABLE KEYS */;
INSERT INTO `car_model_prices` (`id`, `model_id`, `date_from`, `date_to`, `from`, `to`, `price`, `price_per`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL, 0, 0, 0.00, 'hour', '2017-07-14 10:13:43', '2017-07-14 10:13:43'),
	(2, 5, NULL, NULL, 0, 0, 0.00, 'hour', '2017-08-15 12:30:02', '2017-08-15 12:30:02');
/*!40000 ALTER TABLE `car_model_prices` ENABLE KEYS */;

-- Dumping data for table ebdb.car_reservation_details: ~1 rows (approximately)
/*!40000 ALTER TABLE `car_reservation_details` DISABLE KEYS */;
INSERT INTO `car_reservation_details` (`id`, `reservation_id`, `car_type_id`, `car_model_id`, `car_id`, `date_from`, `date_to`, `pickup_location_id`, `return_location_id`, `pickup_near_location`, `return_near_location`, `pickup_date`, `pickup_mileage`, `return_date`, `return_mileage`, `start`, `end`, `rental_days`, `rental_hours`, `price_per_day`, `price_per_day_detail`, `price_per_hour`, `price_per_hour_detail`, `discount_code`, `discount_detail`, `discount`, `car_rental_fee`, `extra_price`, `insurance`, `sub_total`, `tax`, `total_price`, `required_deposit`, `actual_dropoff_datetime`, `dropoff_mileage`, `security_deposit`, `google_event_id`, `created_at`, `updated_at`, `freebies`) VALUES
	(10, 10, 2, 2, 2, '2017-08-07 10:00:00', '2017-08-12 18:00:00', 1, 1, '', '', '2017-08-07 10:00:00', 0, NULL, 0, 0, 0, 5, 8, 200.00, '5 days x $ 40.00', 32.00, '8 hours x $ 4.00', '', '', 0.00, 232.00, 0.00, 0.00, 232.00, 13.92, 245.92, 0.00, NULL, 0, 0, '', '2017-08-05 03:42:13', '2017-08-05 03:42:13', '');
/*!40000 ALTER TABLE `car_reservation_details` ENABLE KEYS */;

-- Dumping data for table ebdb.countries: ~247 rows (approximately)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `fips_code`, `name`, `capital`, `areainsqkm`, `population`, `continent`, `tld`, `currency_code`, `currency_name`, `phone`, `postal_code_format`, `postal_code_regex`, `languages`, `geonameId`, `neighbours`, `equivalent_fips_code`, `currrency_symbol`, `created_at`, `updated_at`) VALUES
	(1, 'AD', 'AND', 20, 'AN', 'Andorra', 'Andorra la Vella', 468, 72000, 'EU', '.ad', 'EUR', 'Euro', '376', 'AD###', '^(?:AD)*(d{3})$', 'ca,fr-AD,pt', 3041565, 'ES,FR', '', '€', NULL, NULL),
	(2, 'AE', 'ARE', 784, 'AE', 'United Arab Emirates', 'Abu Dhabi', 82880, 4621000, 'AS', '.ae', 'AED', 'Dirham', '971', '', '', 'ar-AE,fa,en,hi,ur', 290557, 'SA,OM', '', NULL, NULL, NULL),
	(3, 'AF', 'AFG', 4, 'AF', 'Afghanistan', 'Kabul', 647500, 32738000, 'AS', '.af', 'AFN', 'Afghani', '93', '', '', 'fa-AF,ps,uz-AF,tk', 1149361, 'TM,CN,IR,TJ,PK,UZ', '', '؋', NULL, NULL),
	(4, 'AG', 'ATG', 28, 'AC', 'Antigua and Barbuda', 'St. John\'s', 443, 69000, 'NA', '.ag', 'XCD', 'Dollar', '+1-268', '', '', 'en-AG', 3576396, '', '', '$', NULL, NULL),
	(5, 'AI', 'AIA', 660, 'AV', 'Anguilla', 'The Valley', 102, 13254, 'NA', '.ai', 'XCD', 'Dollar', '+1-264', '', '', 'en-AI', 3573511, '', '', '$', NULL, NULL),
	(6, 'AL', 'ALB', 8, 'AL', 'Albania', 'Tirana', 28748, 3619000, 'EU', '.al', 'ALL', 'Lek', '355', '', '', 'sq,el', 783754, 'MK,GR,CS,ME,RS', '', 'Lek', NULL, NULL),
	(7, 'AM', 'ARM', 51, 'AM', 'Armenia', 'Yerevan', 29800, 2968000, 'AS', '.am', 'AMD', 'Dram', '374', '######', '^(d{6})$', 'hy', 174982, 'GE,IR,AZ,TR', '', NULL, NULL, NULL),
	(8, 'AN', 'ANT', 530, 'NT', 'Netherlands Antilles', 'Willemstad', 960, 136197, 'NA', '.an', 'ANG', 'Guilder', '599', '', '', 'nl-AN,en,es', 3513447, 'GP', '', 'ƒ', NULL, NULL),
	(9, 'AO', 'AGO', 24, 'AO', 'Angola', 'Luanda', 1246700, 12531000, 'AF', '.ao', 'AOA', 'Kwanza', '244', '', '', 'pt-AO', 3351879, 'CD,NA,ZM,CG', '', 'Kz', NULL, NULL),
	(10, 'AQ', 'ATA', 10, 'AY', 'Antarctica', '', 14000000, 0, 'AN', '.aq', '', '', '', '', '', '', 6697173, '', '', NULL, NULL, NULL),
	(11, 'AR', 'ARG', 32, 'AR', 'Argentina', 'Buenos Aires', 2766890, 40677000, 'SA', '.ar', 'ARS', 'Peso', '54', '@####@@@', '^([A-Z]d{4}[A-Z]{3})$', 'es-AR,en,it,de,fr', 3865483, 'CL,BO,UY,PY,BR', '', '$', NULL, NULL),
	(12, 'AS', 'ASM', 16, 'AQ', 'American Samoa', 'Pago Pago', 199, 57881, 'OC', '.as', 'USD', 'Dollar', '+1-684', '', '', 'en-AS,sm,to', 5880801, '', '', '$', NULL, NULL),
	(13, 'AT', 'AUT', 40, 'AU', 'Austria', 'Vienna', 83858, 8205000, 'EU', '.at', 'EUR', 'Euro', '43', '####', '^(d{4})$', 'de-AT,hr,hu,sl', 2782113, 'CH,DE,HU,SK,CZ,IT,SI,LI', '', '€', NULL, NULL),
	(14, 'AU', 'AUS', 36, 'AS', 'Australia', 'Canberra', 7686850, 20600000, 'OC', '.au', 'AUD', 'Dollar', '61', '####', '^(d{4})$', 'en-AU', 2077456, '', '', '$', NULL, NULL),
	(15, 'AW', 'ABW', 533, 'AA', 'Aruba', 'Oranjestad', 193, 71566, 'NA', '.aw', 'AWG', 'Guilder', '297', '', '', 'nl-AW,es,en', 3577279, '', '', 'ƒ', NULL, NULL),
	(16, 'AX', 'ALA', 248, '', 'Aland Islands', 'Mariehamn', 0, 26711, 'EU', '.ax', 'EUR', 'Euro', '+358-18', '', '', 'sv-AX', 661882, '', 'FI', '€', NULL, NULL),
	(17, 'AZ', 'AZE', 31, 'AJ', 'Azerbaijan', 'Baku', 86600, 8177000, 'AS', '.az', 'AZN', 'Manat', '994', 'AZ ####', '^(?:AZ)*(d{4})$', 'az,ru,hy', 587116, 'GE,IR,AM,TR,RU', '', 'ман', NULL, NULL),
	(18, 'BA', 'BIH', 70, 'BK', 'Bosnia and Herzegovina', 'Sarajevo', 51129, 4590000, 'EU', '.ba', 'BAM', 'Marka', '387', '#####', '^(d{5})$', 'bs,hr-BA,sr-BA', 3277605, 'CS,HR,ME,RS', '', 'KM', NULL, NULL),
	(19, 'BB', 'BRB', 52, 'BB', 'Barbados', 'Bridgetown', 431, 281000, 'NA', '.bb', 'BBD', 'Dollar', '+1-246', 'BB#####', '^(?:BB)*(d{5})$', 'en-BB', 3374084, '', '', '$', NULL, NULL),
	(20, 'BD', 'BGD', 50, 'BG', 'Bangladesh', 'Dhaka', 144000, 153546000, 'AS', '.bd', 'BDT', 'Taka', '880', '####', '^(d{4})$', 'bn-BD,en', 1210997, 'MM,IN', '', NULL, NULL, NULL),
	(21, 'BE', 'BEL', 56, 'BE', 'Belgium', 'Brussels', 30510, 10403000, 'EU', '.be', 'EUR', 'Euro', '32', '####', '^(d{4})$', 'nl-BE,fr-BE,de-BE', 2802361, 'DE,NL,LU,FR', '', '€', NULL, NULL),
	(22, 'BF', 'BFA', 854, 'UV', 'Burkina Faso', 'Ouagadougou', 274200, 14761000, 'AF', '.bf', 'XOF', 'Franc', '226', '', '', 'fr-BF', 2361809, 'NE,BJ,GH,CI,TG,ML', '', NULL, NULL, NULL),
	(23, 'BG', 'BGR', 100, 'BU', 'Bulgaria', 'Sofia', 110910, 7262000, 'EU', '.bg', 'BGN', 'Lev', '359', '####', '^(d{4})$', 'bg,tr-BG', 732800, 'MK,GR,RO,CS,TR,RS', '', 'лв', NULL, NULL),
	(24, 'BH', 'BHR', 48, 'BA', 'Bahrain', 'Manama', 665, 718000, 'AS', '.bh', 'BHD', 'Dinar', '973', '####|###', '^(d{3}d?)$', 'ar-BH,en,fa,ur', 290291, '', '', NULL, NULL, NULL),
	(25, 'BI', 'BDI', 108, 'BY', 'Burundi', 'Bujumbura', 27830, 8691000, 'AF', '.bi', 'BIF', 'Franc', '257', '', '', 'fr-BI,rn', 433561, 'TZ,CD,RW', '', NULL, NULL, NULL),
	(26, 'BJ', 'BEN', 204, 'BN', 'Benin', 'Porto-Novo', 112620, 8294000, 'AF', '.bj', 'XOF', 'Franc', '229', '', '', 'fr-BJ', 2395170, 'NE,TG,BF,NG', '', NULL, NULL, NULL),
	(27, 'BL', 'BLM', 652, 'TB', 'Saint Barthélemy', 'Gustavia', 21, 8450, 'NA', '.gp', 'EUR', 'Euro', '590', '### ###', '', 'fr', 3578476, '', '', '€', NULL, NULL),
	(28, 'BM', 'BMU', 60, 'BD', 'Bermuda', 'Hamilton', 53, 65365, 'NA', '.bm', 'BMD', 'Dollar', '+1-441', '@@ ##', '^([A-Z]{2}d{2})$', 'en-BM,pt', 3573345, '', '', '$', NULL, NULL),
	(29, 'BN', 'BRN', 96, 'BX', 'Brunei', 'Bandar Seri Begawan', 5770, 381000, 'AS', '.bn', 'BND', 'Dollar', '673', '@@####', '^([A-Z]{2}d{4})$', 'ms-BN,en-BN', 1820814, 'MY', '', '$', NULL, NULL),
	(30, 'BO', 'BOL', 68, 'BL', 'Bolivia', 'La Paz', 1098580, 9247000, 'SA', '.bo', 'BOB', 'Boliviano', '591', '', '', 'es-BO,qu,ay', 3923057, 'PE,CL,PY,BR,AR', '', '$b', NULL, NULL),
	(31, 'BR', 'BRA', 76, 'BR', 'Brazil', 'Brasília', 8511965, 191908000, 'SA', '.br', 'BRL', 'Real', '55', '#####-###', '^(d{8})$', 'pt-BRR,es,en,fr', 3469034, 'SR,PE,BO,UY,GY,PY,GF,VE,CO,AR', '', 'R$', NULL, NULL),
	(32, 'BS', 'BHS', 44, 'BF', 'Bahamas', 'Nassau', 13940, 301790, 'NA', '.bs', 'BSD', 'Dollar', '+1-242', '', '', 'en-BS', 3572887, '', '', '$', NULL, NULL),
	(33, 'BT', 'BTN', 64, 'BT', 'Bhutan', 'Thimphu', 47000, 2376000, 'AS', '.bt', 'BTN', 'Ngultrum', '975', '', '', 'dz', 1252634, 'CN,IN', '', NULL, NULL, NULL),
	(34, 'BV', 'BVT', 74, 'BV', 'Bouvet Island', '', 0, 0, 'AN', '.bv', 'NOK', 'Krone', '', '', '', '', 3371123, '', '', 'kr', NULL, NULL),
	(35, 'BW', 'BWA', 72, 'BC', 'Botswana', 'Gaborone', 600370, 1842000, 'AF', '.bw', 'BWP', 'Pula', '267', '', '', 'en-BW,tn-BW', 933860, 'ZW,ZA,NA', '', 'P', NULL, NULL),
	(36, 'BY', 'BLR', 112, 'BO', 'Belarus', 'Minsk', 207600, 9685000, 'EU', '.by', 'BYR', 'Ruble', '375', '######', '^(d{6})$', 'be,cru', 630336, 'PL,LT,UA,RU,LV', '', 'p.', NULL, NULL),
	(37, 'BZ', 'BLZ', 84, 'BH', 'Belize', 'Belmopan', 22966, 301000, 'NA', '.bz', 'BZD', 'Dollar', '501', '', '', 'en-BZ,es', 3582678, 'GT,MX', '', 'BZ$', NULL, NULL),
	(38, 'CA', 'CAN', 124, 'CA', 'Canada', 'Ottawa', 9984670, 33679000, 'NA', '.ca', 'CAD', 'Dollar', '1', '@#@ #@#', '^([a-zA-Z]d[a-zA-Z]d[a-zA-Z]d)$', 'en-CA,fr-CA', 6251999, 'US', '', '$', NULL, NULL),
	(39, 'CC', 'CCK', 166, 'CK', 'Cocos Islands', 'West Island', 14, 628, 'AS', '.cc', 'AUD', 'Dollar', '61', '', '', 'ms-CC,en', 1547376, '', '', '$', NULL, NULL),
	(40, 'CD', 'COD', 180, 'CG', 'Democratic Republic of the Congo', 'Kinshasa', 2345410, 60085004, 'AF', '.cd', 'CDF', 'Franc', '243', '', '', 'fr-CD,ln,kg', 203312, 'TZ,CF,SD,RW,ZM,BI,UG,CG,AO', '', NULL, NULL, NULL),
	(41, 'CF', 'CAF', 140, 'CT', 'Central African Republic', 'Bangui', 622984, 4434000, 'AF', '.cf', 'XAF', 'Franc', '236', '', '', 'fr-CF,ln,kg', 239880, 'TD,SD,CD,CM,CG', '', 'FCF', NULL, NULL),
	(42, 'CG', 'COG', 178, 'CF', 'Republic of the Congo', 'Brazzaville', 342000, 3039126, 'AF', '.cg', 'XAF', 'Franc', '242', '', '', 'fr-CG,kg,ln-CG', 2260494, 'CF,GA,CD,CM,AO', '', 'FCF', NULL, NULL),
	(43, 'CH', 'CHE', 756, 'SZ', 'Switzerland', 'Berne', 41290, 7581000, 'EU', '.ch', 'CHF', 'Franc', '41', '####', '^(d{4})$', 'de-CH,fr-CH,it-CH,rm', 2658434, 'DE,IT,LI,FR,AT', '', 'CHF', NULL, NULL),
	(44, 'CI', 'CIV', 384, 'IV', 'Ivory Coast', 'Yamoussoukro', 322460, 18373000, 'AF', '.ci', 'XOF', 'Franc', '225', '', '', 'fr-CI', 2287781, 'LR,GH,GN,BF,ML', '', NULL, NULL, NULL),
	(45, 'CK', 'COK', 184, 'CW', 'Cook Islands', 'Avarua', 240, 21388, 'OC', '.ck', 'NZD', 'Dollar', '682', '', '', 'en-CK,mi', 1899402, '', '', '$', NULL, NULL),
	(46, 'CL', 'CHL', 152, 'CI', 'Chile', 'Santiago', 756950, 16432000, 'SA', '.cl', 'CLP', 'Peso', '56', '#######', '^(d{7})$', 'es-CL', 3895114, 'PE,BO,AR', '', NULL, NULL, NULL),
	(47, 'CM', 'CMR', 120, 'CM', 'Cameroon', 'Yaoundé', 475440, 18467000, 'AF', '.cm', 'XAF', 'Franc', '237', '', '', 'en-CM,fr-CM', 2233387, 'TD,CF,GA,GQ,CG,NG', '', 'FCF', NULL, NULL),
	(48, 'CN', 'CHN', 156, 'CH', 'China', 'Beijing', 9596960, 1330044000, 'AS', '.cn', 'CNY', 'Yuan Renminbi', '86', '######', '^(d{6})$', 'zh-CN,yue,wuu', 1814991, 'LA,BT,TJ,KZ,MN,AF,NP,MM,KG,PK,KP,RU,VN,IN', '', '¥', NULL, NULL),
	(49, 'CO', 'COL', 170, 'CO', 'Colombia', 'Bogotá', 1138910, 45013000, 'SA', '.co', 'COP', 'Peso', '57', '', '', 'es-CO', 3686110, 'EC,PE,PA,BR,VE', '', '$', NULL, NULL),
	(50, 'CR', 'CRI', 188, 'CS', 'Costa Rica', 'San José', 51100, 4191000, 'NA', '.cr', 'CRC', 'Colon', '506', '####', '^(d{4})$', 'es-CR,en', 3624060, 'PA,NI', '', '₡', NULL, NULL),
	(51, 'CU', 'CUB', 192, 'CU', 'Cuba', 'Havana', 110860, 11423000, 'NA', '.cu', 'CUP', 'Peso', '53', 'CP #####', '^(?:CP)*(d{5})$', 'es-CU', 3562981, 'US', '', '₱', NULL, NULL),
	(52, 'CV', 'CPV', 132, 'CV', 'Cape Verde', 'Praia', 4033, 426000, 'AF', '.cv', 'CVE', 'Escudo', '238', '####', '^(d{4})$', 'pt-CV', 3374766, '', '', NULL, NULL, NULL),
	(53, 'CX', 'CXR', 162, 'KT', 'Christmas Island', 'Flying Fish Cove', 135, 361, 'AS', '.cx', 'AUD', 'Dollar', '61', '####', '^(d{4})$', 'en,zh,ms-CC', 2078138, '', '', '$', NULL, NULL),
	(54, 'CY', 'CYP', 196, 'CY', 'Cyprus', 'Nicosia', 9250, 792000, 'EU', '.cy', 'CYP', 'Pound', '357', '####', '^(d{4})$', 'el-CY,tr-CY,en', 146669, '', '', NULL, NULL, NULL),
	(55, 'CZ', 'CZE', 203, 'EZ', 'Czech Republic', 'Prague', 78866, 10220000, 'EU', '.cz', 'CZK', 'Koruna', '420', '### ##', '^(d{5})$', 'cs,sk', 3077311, 'PL,DE,SK,AT', '', 'K', NULL, NULL),
	(56, 'DE', 'DEU', 276, 'GM', 'Germany', 'Berlin', 357021, 82369000, 'EU', '.de', 'EUR', 'Euro', '49', '#####', '^(d{5})$', 'de', 2921044, 'CH,PL,NL,DK,BE,CZ,LU,FR,AT', '', '€', NULL, NULL),
	(57, 'DJ', 'DJI', 262, 'DJ', 'Djibouti', 'Djibouti', 23000, 506000, 'AF', '.dj', 'DJF', 'Franc', '253', '', '', 'fr-DJ,ar,so-DJ,aa', 223816, 'ER,ET,SO', '', NULL, NULL, NULL),
	(58, 'DK', 'DNK', 208, 'DA', 'Denmark', 'Copenhagen', 43094, 5484000, 'EU', '.dk', 'DKK', 'Krone', '45', '####', '^(d{4})$', 'da-DK,en,fo,de-DK', 2623032, 'DE', '', 'kr', NULL, NULL),
	(59, 'DM', 'DMA', 212, 'DO', 'Dominica', 'Roseau', 754, 72000, 'NA', '.dm', 'XCD', 'Dollar', '+1-767', '', '', 'en-DM', 3575830, '', '', '$', NULL, NULL),
	(60, 'DO', 'DOM', 214, 'DR', 'Dominican Republic', 'Santo Domingo', 48730, 9507000, 'NA', '.do', 'DOP', 'Peso', '+1-809 and 1-829', '#####', '^(d{5})$', 'es-DO', 3508796, 'HT', '', 'RD$', NULL, NULL),
	(61, 'DZ', 'DZA', 12, 'AG', 'Algeria', 'Algiers', 2381740, 33739000, 'AF', '.dz', 'DZD', 'Dinar', '213', '#####', '^(d{5})$', 'ar-DZ', 2589581, 'NE,EH,LY,MR,TN,MA,ML', '', NULL, NULL, NULL),
	(62, 'EC', 'ECU', 218, 'EC', 'Ecuador', 'Quito', 283560, 13927000, 'SA', '.ec', 'USD', 'Dollar', '593', '@####@', '^([a-zA-Z]d{4}[a-zA-Z])$', 'es-EC', 3658394, 'PE,CO', '', '$', NULL, NULL),
	(63, 'EE', 'EST', 233, 'EN', 'Estonia', 'Tallinn', 45226, 1307000, 'EU', '.ee', 'EEK', 'Kroon', '372', '#####', '^(d{5})$', 'et,ru', 453733, 'RU,LV', '', 'kr', NULL, NULL),
	(64, 'EG', 'EGY', 818, 'EG', 'Egypt', 'Cairo', 1001450, 81713000, 'AF', '.eg', 'EGP', 'Pound', '20', '#####', '^(d{5})$', 'ar-EG,en,fr', 357994, 'LY,SD,IL', '', '£', NULL, NULL),
	(65, 'EH', 'ESH', 732, 'WI', 'Western Sahara', 'El-Aaiun', 266000, 273008, 'AF', '.eh', 'MAD', 'Dirham', '212', '', '', 'ar,mey', 2461445, 'DZ,MR,MA', '', NULL, NULL, NULL),
	(66, 'ER', 'ERI', 232, 'ER', 'Eritrea', 'Asmara', 121320, 5028000, 'AF', '.er', 'ERN', 'Nakfa', '291', '', '', 'aa-ER,ar,tig,kun,ti-ER', 338010, 'ET,SD,DJ', '', 'Nfk', NULL, NULL),
	(67, 'ES', 'ESP', 724, 'SP', 'Spain', 'Madrid', 504782, 40491000, 'EU', '.es', 'EUR', 'Euro', '34', '#####', '^(d{5})$', 'es-ES,ca,gl,eu', 2510769, 'AD,PT,GI,FR,MA', '', '€', NULL, NULL),
	(68, 'ET', 'ETH', 231, 'ET', 'Ethiopia', 'Addis Ababa', 1127127, 78254000, 'AF', '.et', 'ETB', 'Birr', '251', '####', '^(d{4})$', 'am,en-ET,om-ET,ti-ET,so-ET,sid,so-ET', 337996, 'ER,KE,SD,SO,DJ', '', NULL, NULL, NULL),
	(69, 'FI', 'FIN', 246, 'FI', 'Finland', 'Helsinki', 337030, 5244000, 'EU', '.fi', 'EUR', 'Euro', '358', 'FI-#####', '^(?:FI)*(d{5})$', 'fi-FI,sv-FI,smn', 660013, 'NO,RU,SE', '', '€', NULL, NULL),
	(70, 'FJ', 'FJI', 242, 'FJ', 'Fiji', 'Suva', 18270, 931000, 'OC', '.fj', 'FJD', 'Dollar', '679', '', '', 'en-FJ,fj', 2205218, '', '', '$', NULL, NULL),
	(71, 'FK', 'FLK', 238, 'FK', 'Falkland Islands', 'Stanley', 12173, 2638, 'SA', '.fk', 'FKP', 'Pound', '500', '', '', 'en-FK', 3474414, '', '', '£', NULL, NULL),
	(72, 'FM', 'FSM', 583, 'FM', 'Micronesia', 'Palikir', 702, 108105, 'OC', '.fm', 'USD', 'Dollar', '691', '#####', '^(d{5})$', 'en-FM,chk,pon,yap,kos,uli,woe,nkr,kpg', 2081918, '', '', '$', NULL, NULL),
	(73, 'FO', 'FRO', 234, 'FO', 'Faroe Islands', 'Tórshavn', 1399, 48228, 'EU', '.fo', 'DKK', 'Krone', '298', 'FO-###', '^(?:FO)*(d{3})$', 'fo,da-FO', 2622320, '', '', 'kr', NULL, NULL),
	(74, 'FR', 'FRA', 250, 'FR', 'France', 'Paris', 547030, 64094000, 'EU', '.fr', 'EUR', 'Euro', '33', '#####', '^(d{5})$', 'fr-FR,frp,br,co,ca,eu', 3017382, 'CH,DE,BE,LU,IT,AD,MC,ES', '', '€', NULL, NULL),
	(75, 'GA', 'GAB', 266, 'GB', 'Gabon', 'Libreville', 267667, 1484000, 'AF', '.ga', 'XAF', 'Franc', '241', '', '', 'fr-GA', 2400553, 'CM,GQ,CG', '', 'FCF', NULL, NULL),
	(76, 'GB', 'GBR', 826, 'UK', 'United Kingdom', 'London', 244820, 60943000, 'EU', '.uk', 'GBP', 'Pound', '44', '@# #@@|@## #@@|@@# #@@|@@## #@@|@#@ #@@|@@#@ #@@|GIR0AA', '^(([A-Z]d{2}[A-Z]{2})|([A-Z]d{3}[A-Z]{2})|([A-Z]{2}d{2}[A-Z]{2})|([A-Z]{2}d{3}[A-Z]{2})|([A-Z]d[A-Z]d[A-Z]{2})|([A-Z]{2}d[A-Z]d[A-Z]{2})|(GIR0AA))$', 'en-GB,cy-GB,gd', 2635167, 'IE', '', '£', NULL, NULL),
	(77, 'GD', 'GRD', 308, 'GJ', 'Grenada', 'St. George\'s', 344, 90000, 'NA', '.gd', 'XCD', 'Dollar', '+1-473', '', '', 'en-GD', 3580239, '', '', '$', NULL, NULL),
	(78, 'GE', 'GEO', 268, 'GG', 'Georgia', 'Tbilisi', 69700, 4630000, 'AS', '.ge', 'GEL', 'Lari', '995', '####', '^(d{4})$', 'ka,ru,hy,az', 614540, 'AM,AZ,TR,RU', '', NULL, NULL, NULL),
	(79, 'GF', 'GUF', 254, 'FG', 'French Guiana', 'Cayenne', 91000, 195506, 'SA', '.gf', 'EUR', 'Euro', '594', '#####', '^((97)|(98)3d{2})$', 'fr-GF', 3381670, 'SR,BR', '', '€', NULL, NULL),
	(80, 'GG', 'GGY', 831, 'GK', 'Guernsey', 'St Peter Port', 78, 65228, 'EU', '.gg', 'GGP', 'Pound', '+44-1481', '@# #@@|@## #@@|@@# #@@|@@## #@@|@#@ #@@|@@#@ #@@|GIR0AA', '^(([A-Z]d{2}[A-Z]{2})|([A-Z]d{3}[A-Z]{2})|([A-Z]{2}d{2}[A-Z]{2})|([A-Z]{2}d{3}[A-Z]{2})|([A-Z]d[A-Z]d[A-Z]{2})|([A-Z]{2}d[A-Z]d[A-Z]{2})|(GIR0AA))$', 'en,fr', 3042362, '', '', '£', NULL, NULL),
	(81, 'GH', 'GHA', 288, 'GH', 'Ghana', 'Accra', 239460, 23382000, 'AF', '.gh', 'GHC', 'Cedi', '233', '', '', 'en-GH,ak,ee,tw', 2300660, 'CI,TG,BF', '', '¢', NULL, NULL),
	(82, 'GI', 'GIB', 292, 'GI', 'Gibraltar', 'Gibraltar', 7, 27884, 'EU', '.gi', 'GIP', 'Pound', '350', '', '', 'en-GI,es,it,pt', 2411586, 'ES', '', '£', NULL, NULL),
	(83, 'GL', 'GRL', 304, 'GL', 'Greenland', 'Nuuk', 2166086, 56375, 'NA', '.gl', 'DKK', 'Krone', '299', '####', '^(d{4})$', 'kl,da-GL,en', 3425505, '', '', 'kr', NULL, NULL),
	(84, 'GM', 'GMB', 270, 'GA', 'Gambia', 'Banjul', 11300, 1593256, 'AF', '.gm', 'GMD', 'Dalasi', '220', '', '', 'en-GM,mnk,wof,wo,ff', 2413451, 'SN', '', 'D', NULL, NULL),
	(85, 'GN', 'GIN', 324, 'GV', 'Guinea', 'Conakry', 245857, 10211000, 'AF', '.gn', 'GNF', 'Franc', '224', '', '', 'fr-GN', 2420477, 'LR,SN,SL,CI,GW,ML', '', NULL, NULL, NULL),
	(86, 'GP', 'GLP', 312, 'GP', 'Guadeloupe', 'Basse-Terre', 1780, 443000, 'NA', '.gp', 'EUR', 'Euro', '590', '#####', '^((97)|(98)d{3})$', 'fr-GP', 3579143, 'AN', '', '€', NULL, NULL),
	(87, 'GQ', 'GNQ', 226, 'EK', 'Equatorial Guinea', 'Malabo', 28051, 562000, 'AF', '.gq', 'XAF', 'Franc', '240', '', '', 'es-GQ,fr', 2309096, 'GA,CM', '', 'FCF', NULL, NULL),
	(88, 'GR', 'GRC', 300, 'GR', 'Greece', 'Athens', 131940, 10722000, 'EU', '.gr', 'EUR', 'Euro', '30', '### ##', '^(d{5})$', 'el-GR,en,fr', 390903, 'AL,MK,TR,BG', '', '€', NULL, NULL),
	(89, 'GS', 'SGS', 239, 'SX', 'South Georgia and the South Sandwich Islands', 'Grytviken', 3903, 100, 'AN', '.gs', 'GBP', 'Pound', '', '', '', 'en', 3474415, '', '', '£', NULL, NULL),
	(90, 'GT', 'GTM', 320, 'GT', 'Guatemala', 'Guatemala City', 108890, 13002000, 'NA', '.gt', 'GTQ', 'Quetzal', '502', '#####', '^(d{5})$', 'es-GT', 3595528, 'MX,HN,BZ,SV', '', 'Q', NULL, NULL),
	(91, 'GU', 'GUM', 316, 'GQ', 'Guam', 'Hagåtña', 549, 168564, 'OC', '.gu', 'USD', 'Dollar', '+1-671', '969##', '^(969d{2})$', 'en-GU,ch-GU', 4043988, '', '', '$', NULL, NULL),
	(92, 'GW', 'GNB', 624, 'PU', 'Guinea-Bissau', 'Bissau', 36120, 1503000, 'AF', '.gw', 'XOF', 'Franc', '245', '####', '^(d{4})$', 'pt-GW,pov', 2372248, 'SN,GN', '', NULL, NULL, NULL),
	(93, 'GY', 'GUY', 328, 'GY', 'Guyana', 'Georgetown', 214970, 770000, 'SA', '.gy', 'GYD', 'Dollar', '592', '', '', 'en-GY', 3378535, 'SR,BR,VE', '', '$', NULL, NULL),
	(94, 'HK', 'HKG', 344, 'HK', 'Hong Kong', 'Hong Kong', 1092, 6898686, 'AS', '.hk', 'HKD', 'Dollar', '852', '', '', 'zh-HK,yue,zh,en', 1819730, '', '', '$', NULL, NULL),
	(95, 'HM', 'HMD', 334, 'HM', 'Heard Island and McDonald Islands', '', 412, 0, 'AN', '.hm', 'AUD', 'Dollar', ' ', '', '', '', 1547314, '', '', '$', NULL, NULL),
	(96, 'HN', 'HND', 340, 'HO', 'Honduras', 'Tegucigalpa', 112090, 7639000, 'NA', '.hn', 'HNL', 'Lempira', '504', '@@####', '^([A-Z]{2}d{4})$', 'es-HN', 3608932, 'GT,NI,SV', '', 'L', NULL, NULL),
	(97, 'HR', 'HRV', 191, 'HR', 'Croatia', 'Zagreb', 56542, 4491000, 'EU', '.hr', 'HRK', 'Kuna', '385', 'HR-#####', '^(?:HR)*(d{5})$', 'hr-HR,sr', 3202326, 'HU,SI,CS,BA,ME,RS', '', 'kn', NULL, NULL),
	(98, 'HT', 'HTI', 332, 'HA', 'Haiti', 'Port-au-Prince', 27750, 8924000, 'NA', '.ht', 'HTG', 'Gourde', '509', 'HT####', '^(?:HT)*(d{4})$', 'ht,fr-HT', 3723988, 'DO', '', 'G', NULL, NULL),
	(99, 'HU', 'HUN', 348, 'HU', 'Hungary', 'Budapest', 93030, 9930000, 'EU', '.hu', 'HUF', 'Forint', '36', '####', '^(d{4})$', 'hu-HU', 719819, 'SK,SI,RO,UA,CS,HR,AT,RS', '', 'Ft', NULL, NULL),
	(100, 'ID', 'IDN', 360, 'ID', 'Indonesia', 'Jakarta', 1919440, 237512000, 'AS', '.id', 'IDR', 'Rupiah', '62', '#####', '^(d{5})$', 'id,en,nl,jv', 1643084, 'PG,TL,MY', '', 'Rp', NULL, NULL),
	(101, 'IE', 'IRL', 372, 'EI', 'Ireland', 'Dublin', 70280, 4156000, 'EU', '.ie', 'EUR', 'Euro', '353', '', '', 'en-IE,ga-IE', 2963597, 'GB', '', '€', NULL, NULL),
	(102, 'IL', 'ISR', 376, 'IS', 'Israel', 'Jerusalem', 20770, 6500000, 'AS', '.il', 'ILS', 'Shekel', '972', '#####', '^(d{5})$', 'he,ar-IL,en-IL,', 294640, 'SY,JO,LB,EG,PS', '', '₪', NULL, NULL),
	(103, 'IM', 'IMN', 833, 'IM', 'Isle of Man', 'Douglas, Isle of Man', 572, 75049, 'EU', '.im', 'GPD', 'Pound', '+44-1624', '@# #@@|@## #@@|@@# #@@|@@## #@@|@#@ #@@|@@#@ #@@|GIR0AA', '^(([A-Z]d{2}[A-Z]{2})|([A-Z]d{3}[A-Z]{2})|([A-Z]{2}d{2}[A-Z]{2})|([A-Z]{2}d{3}[A-Z]{2})|([A-Z]d[A-Z]d[A-Z]{2})|([A-Z]{2}d[A-Z]d[A-Z]{2})|(GIR0AA))$', 'en,gv', 3042225, '', '', '£', NULL, NULL),
	(104, 'IN', 'IND', 356, 'IN', 'India', 'New Delhi', 3287590, 1147995000, 'AS', '.in', 'INR', 'Rupee', '91', '######', '^(d{6})$', 'en-IN,hi,bn,te,mr,ta,ur,gu,ml,kn,or,pa,as,ks,sd,sa,ur-IN', 1269750, 'CN,NP,MM,BT,PK,BD', '', '₨', NULL, NULL),
	(105, 'IO', 'IOT', 86, 'IO', 'British Indian Ocean Territory', 'Diego Garcia', 60, 0, 'AS', '.io', 'USD', 'Dollar', '246', '', '', 'en-IO', 1282588, '', '', '$', NULL, NULL),
	(106, 'IQ', 'IRQ', 368, 'IZ', 'Iraq', 'Baghdad', 437072, 28221000, 'AS', '.iq', 'IQD', 'Dinar', '964', '#####', '^(d{5})$', 'ar-IQ,ku,hy', 99237, 'SY,SA,IR,JO,TR,KW', '', NULL, NULL, NULL),
	(107, 'IR', 'IRN', 364, 'IR', 'Iran', 'Tehran', 1648000, 65875000, 'AS', '.ir', 'IRR', 'Rial', '98', '##########', '^(d{10})$', 'fa-IR,ku', 130758, 'TM,AF,IQ,AM,PK,AZ,TR', '', '﷼', NULL, NULL),
	(108, 'IS', 'ISL', 352, 'IC', 'Iceland', 'Reykjavík', 103000, 304000, 'EU', '.is', 'ISK', 'Krona', '354', '###', '^(d{3})$', 'is,en,de,da,sv,no', 2629691, '', '', 'kr', NULL, NULL),
	(109, 'IT', 'ITA', 380, 'IT', 'Italy', 'Rome', 301230, 58145000, 'EU', '.it', 'EUR', 'Euro', '39', '####', '^(d{5})$', 'it-IT,de-IT,fr-IT,sl', 3175395, 'CH,VA,SI,SM,FR,AT', '', '€', NULL, NULL),
	(110, 'JE', 'JEY', 832, 'JE', 'Jersey', 'Saint Helier', 116, 90812, 'EU', '.je', 'JEP', 'Pound', '+44-1534', '@# #@@|@## #@@|@@# #@@|@@## #@@|@#@ #@@|@@#@ #@@|GIR0AA', '^(([A-Z]d{2}[A-Z]{2})|([A-Z]d{3}[A-Z]{2})|([A-Z]{2}d{2}[A-Z]{2})|([A-Z]{2}d{3}[A-Z]{2})|([A-Z]d[A-Z]d[A-Z]{2})|([A-Z]{2}d[A-Z]d[A-Z]{2})|(GIR0AA))$', 'en,pt', 3042142, '', '', '£', NULL, NULL),
	(111, 'JM', 'JAM', 388, 'JM', 'Jamaica', 'Kingston', 10991, 2801000, 'NA', '.jm', 'JMD', 'Dollar', '+1-876', '', '', 'en-JM', 3489940, '', '', '$', NULL, NULL),
	(112, 'JO', 'JOR', 400, 'JO', 'Jordan', 'Amman', 92300, 6198000, 'AS', '.jo', 'JOD', 'Dinar', '962', '#####', '^(d{5})$', 'ar-JO,en', 248816, 'SY,SA,IQ,IL,PS', '', NULL, NULL, NULL),
	(113, 'JP', 'JPN', 392, 'JA', 'Japan', 'Tokyo', 377835, 127288000, 'AS', '.jp', 'JPY', 'Yen', '81', '###-####', '^(d{7})$', 'ja', 1861060, '', '', '¥', NULL, NULL),
	(114, 'KE', 'KEN', 404, 'KE', 'Kenya', 'Nairobi', 582650, 37953000, 'AF', '.ke', 'KES', 'Shilling', '254', '#####', '^(d{5})$', 'en-KE,sw-KE', 192950, 'ET,TZ,SD,SO,UG', '', NULL, NULL, NULL),
	(115, 'KG', 'KGZ', 417, 'KG', 'Kyrgyzstan', 'Bishkek', 198500, 5356000, 'AS', '.kg', 'KGS', 'Som', '996', '######', '^(d{6})$', 'ky,uz,ru', 1527747, 'CN,TJ,UZ,KZ', '', 'лв', NULL, NULL),
	(116, 'KH', 'KHM', 116, 'CB', 'Cambodia', 'Phnom Penh', 181040, 14241000, 'AS', '.kh', 'KHR', 'Riels', '855', '#####', '^(d{5})$', 'km,fr,en', 1831722, 'LA,TH,VN', '', '៛', NULL, NULL),
	(117, 'KI', 'KIR', 296, 'KR', 'Kiribati', 'South Tarawa', 811, 110000, 'OC', '.ki', 'AUD', 'Dollar', '686', '', '', 'en-KI,gil', 4030945, '', '', '$', NULL, NULL),
	(118, 'KM', 'COM', 174, 'CN', 'Comoros', 'Moroni', 2170, 731000, 'AF', '.km', 'KMF', 'Franc', '269', '', '', 'ar,fr-KM', 921929, '', '', NULL, NULL, NULL),
	(119, 'KN', 'KNA', 659, 'SC', 'Saint Kitts and Nevis', 'Basseterre', 261, 39000, 'NA', '.kn', 'XCD', 'Dollar', '+1-869', '', '', 'en-KN', 3575174, '', '', '$', NULL, NULL),
	(120, 'KP', 'PRK', 408, 'KN', 'North Korea', 'Pyongyang', 120540, 22912177, 'AS', '.kp', 'KPW', 'Won', '850', '###-###', '^(d{6})$', 'ko-KP', 1873107, 'CN,KR,RU', '', '₩', NULL, NULL),
	(121, 'KR', 'KOR', 410, 'KS', 'South Korea', 'Seoul', 98480, 48422644, 'AS', '.kr', 'KRW', 'Won', '82', 'SEOUL ###-###', '^(?:SEOUL)*(d{6})$', 'ko-KR,en', 1835841, 'KP', '', '₩', NULL, NULL),
	(122, 'KW', 'KWT', 414, 'KU', 'Kuwait', 'Kuwait City', 17820, 2596000, 'AS', '.kw', 'KWD', 'Dinar', '965', '#####', '^(d{5})$', 'ar-KW,en', 285570, 'SA,IQ', '', NULL, NULL, NULL),
	(123, 'KY', 'CYM', 136, 'CJ', 'Cayman Islands', 'George Town', 262, 44270, 'NA', '.ky', 'KYD', 'Dollar', '+1-345', '', '', 'en-KY', 3580718, '', '', '$', NULL, NULL),
	(124, 'KZ', 'KAZ', 398, 'KZ', 'Kazakhstan', 'Astana', 2717300, 15340000, 'AS', '.kz', 'KZT', 'Tenge', '7', '######', '^(d{6})$', 'kk,ru', 1522867, 'TM,CN,KG,UZ,RU', '', 'лв', NULL, NULL),
	(125, 'LA', 'LAO', 418, 'LA', 'Laos', 'Vientiane', 236800, 6677000, 'AS', '.la', 'LAK', 'Kip', '856', '#####', '^(d{5})$', 'lo,fr,en', 1655842, 'CN,MM,KH,TH,VN', '', '₭', NULL, NULL),
	(126, 'LB', 'LBN', 422, 'LE', 'Lebanon', 'Beirut', 10400, 3971000, 'AS', '.lb', 'LBP', 'Pound', '961', '#### ####|####', '^(d{4}(d{4})?)$', 'ar-LB,fr-LB,en,hy', 272103, 'SY,IL', '', '£', NULL, NULL),
	(127, 'LC', 'LCA', 662, 'ST', 'Saint Lucia', 'Castries', 616, 172000, 'NA', '.lc', 'XCD', 'Dollar', '+1-758', '', '', 'en-LC', 3576468, '', '', '$', NULL, NULL),
	(128, 'LI', 'LIE', 438, 'LS', 'Liechtenstein', 'Vaduz', 160, 34000, 'EU', '.li', 'CHF', 'Franc', '423', '####', '^(d{4})$', 'de-LI', 3042058, 'CH,AT', '', 'CHF', NULL, NULL),
	(129, 'LK', 'LKA', 144, 'CE', 'Sri Lanka', 'Colombo', 65610, 21128000, 'AS', '.lk', 'LKR', 'Rupee', '94', '#####', '^(d{5})$', 'si,ta,en', 1227603, '', '', '₨', NULL, NULL),
	(130, 'LR', 'LBR', 430, 'LI', 'Liberia', 'Monrovia', 111370, 3334000, 'AF', '.lr', 'LRD', 'Dollar', '231', '####', '^(d{4})$', 'en-LR', 2275384, 'SL,CI,GN', '', '$', NULL, NULL),
	(131, 'LS', 'LSO', 426, 'LT', 'Lesotho', 'Maseru', 30355, 2128000, 'AF', '.ls', 'LSL', 'Loti', '266', '###', '^(d{3})$', 'en-LS,st,zu,xh', 932692, 'ZA', '', 'L', NULL, NULL),
	(132, 'LT', 'LTU', 440, 'LH', 'Lithuania', 'Vilnius', 65200, 3565000, 'EU', '.lt', 'LTL', 'Litas', 'Lt', 'LT-#####', '^(?:LT)*(d{5})$', 'lt,ru,pl', 597427, 'PL,BY,RU,LV', '', 'Lt', NULL, NULL),
	(133, 'LU', 'LUX', 442, 'LU', 'Luxembourg', 'Luxembourg', 2586, 486000, 'EU', '.lu', 'EUR', 'Euro', '352', '####', '^(d{4})$', 'lb,de-LU,fr-LU', 2960313, 'DE,BE,FR', '', '€', NULL, NULL),
	(134, 'LV', 'LVA', 428, 'LG', 'Latvia', 'Riga', 64589, 2245000, 'EU', '.lv', 'LVL', 'Lat', '371', 'LV-####', '^(?:LV)*(d{4})$', 'lv,ru,lt', 458258, 'LT,EE,BY,RU', '', 'Ls', NULL, NULL),
	(135, 'LY', 'LBY', 434, 'LY', 'Libya', 'Tripolis', 1759540, 6173000, 'AF', '.ly', 'LYD', 'Dinar', '218', '', '', 'ar-LY,it,en', 2215636, 'TD,NE,DZ,SD,TN,EG', '', NULL, NULL, NULL),
	(136, 'MA', 'MAR', 504, 'MO', 'Morocco', 'Rabat', 446550, 34272000, 'AF', '.ma', 'MAD', 'Dirham', '212', '#####', '^(d{5})$', 'ar-MA,fr', 2542007, 'DZ,EH,ES', '', NULL, NULL, NULL),
	(137, 'MC', 'MCO', 492, 'MN', 'Monaco', 'Monaco', 2, 32000, 'EU', '.mc', 'EUR', 'Euro', '377', '#####', '^(d{5})$', 'fr-MC,en,it', 2993457, 'FR', '', '€', NULL, NULL),
	(138, 'MD', 'MDA', 498, 'MD', 'Moldova', 'ChiÅŸinÄƒu', 33843, 4324000, 'EU', '.md', 'MDL', 'Leu', '373', 'MD-####', '^(?:MD)*(d{4})$', 'mo,ro,ru,gag,tr', 617790, 'RO,UA', '', NULL, NULL, NULL),
	(139, 'ME', 'MNE', 499, 'MJ', 'Montenegro', 'Podgorica', 14026, 678000, 'EU', '.cs', 'EUR', 'Euro', '381', '#####', '^(d{5})$', 'sr,hu,bs,sq,hr,rom', 3194884, 'AL,HR,BA,RS', '', '€', NULL, NULL),
	(140, 'MF', 'MAF', 663, 'RN', 'Saint Martin', 'Marigot', 53, 33100, 'NA', '.gp', 'EUR', 'Euro', '590', '### ###', '', 'fr', 3578421, '', '', '€', NULL, NULL),
	(141, 'MG', 'MDG', 450, 'MA', 'Madagascar', 'Antananarivo', 587040, 20042000, 'AF', '.mg', 'MGA', 'Ariary', '261', '###', '^(d{3})$', 'fr-MG,mg', 1062947, '', '', NULL, NULL, NULL),
	(142, 'MH', 'MHL', 584, 'RM', 'Marshall Islands', 'Uliga', 181, 11628, 'OC', '.mh', 'USD', 'Dollar', '692', '', '', 'mh,en-MH', 2080185, '', '', '$', NULL, NULL),
	(143, 'MK', 'MKD', 807, 'MK', 'Macedonia', 'Skopje', 25333, 2061000, 'EU', '.mk', 'MKD', 'Denar', '389', '####', '^(d{4})$', 'mk,sq,tr,rmm,sr', 718075, 'AL,GR,CS,BG,RS', '', 'ден', NULL, NULL),
	(144, 'ML', 'MLI', 466, 'ML', 'Mali', 'Bamako', 1240000, 12324000, 'AF', '.ml', 'XOF', 'Franc', '223', '', '', 'fr-ML,bm', 2453866, 'SN,NE,DZ,CI,GN,MR,BF', '', NULL, NULL, NULL),
	(145, 'MM', 'MMR', 104, 'BM', 'Myanmar', 'Yangon', 678500, 47758000, 'AS', '.mm', 'MMK', 'Kyat', '95', '#####', '^(d{5})$', 'my', 1327865, 'CN,LA,TH,BD,IN', '', 'K', NULL, NULL),
	(146, 'MN', 'MNG', 496, 'MG', 'Mongolia', 'Ulan Bator', 1565000, 2996000, 'AS', '.mn', 'MNT', 'Tugrik', '976', '######', '^(d{6})$', 'mn,ru', 2029969, 'CN,RU', '', '₮', NULL, NULL),
	(147, 'MO', 'MAC', 446, 'MC', 'Macao', 'Macao', 254, 449198, 'AS', '.mo', 'MOP', 'Pataca', '853', '', '', 'zh,zh-MO', 1821275, '', '', 'MOP', NULL, NULL),
	(148, 'MP', 'MNP', 580, 'CQ', 'Northern Mariana Islands', 'Saipan', 477, 80362, 'OC', '.mp', 'USD', 'Dollar', '+1-670', '', '', 'fil,tl,zh,ch-MP,en-MP', 4041467, '', '', '$', NULL, NULL),
	(149, 'MQ', 'MTQ', 474, 'MB', 'Martinique', 'Fort-de-France', 1100, 432900, 'NA', '.mq', 'EUR', 'Euro', '596', '#####', '^(d{5})$', 'fr-MQ', 3570311, '', '', '€', NULL, NULL),
	(150, 'MR', 'MRT', 478, 'MR', 'Mauritania', 'Nouakchott', 1030700, 3364000, 'AF', '.mr', 'MRO', 'Ouguiya', '222', '', '', 'ar-MR,fuc,snk,fr,mey,wo', 2378080, 'SN,DZ,EH,ML', '', 'UM', NULL, NULL),
	(151, 'MS', 'MSR', 500, 'MH', 'Montserrat', 'Plymouth', 102, 9341, 'NA', '.ms', 'XCD', 'Dollar', '+1-664', '', '', 'en-MS', 3578097, '', '', '$', NULL, NULL),
	(152, 'MT', 'MLT', 470, 'MT', 'Malta', 'Valletta', 316, 403000, 'EU', '.mt', 'MTL', 'Lira', '356', '@@@ ###|@@@ ##', '^([A-Z]{3}d{2}d?)$', 'mt,en-MT', 2562770, '', '', NULL, NULL, NULL),
	(153, 'MU', 'MUS', 480, 'MP', 'Mauritius', 'Port Louis', 2040, 1260000, 'AF', '.mu', 'MUR', 'Rupee', '230', '', '', 'en-MU,bho,fr', 934292, '', '', '₨', NULL, NULL),
	(154, 'MV', 'MDV', 462, 'MV', 'Maldives', 'Malé', 300, 379000, 'AS', '.mv', 'MVR', 'Rufiyaa', '960', '#####', '^(d{5})$', 'dv,en', 1282028, '', '', 'Rf', NULL, NULL),
	(155, 'MW', 'MWI', 454, 'MI', 'Malawi', 'Lilongwe', 118480, 13931000, 'AF', '.mw', 'MWK', 'Kwacha', '265', '', '', 'ny,yao,tum,swk', 927384, 'TZ,MZ,ZM', '', 'MK', NULL, NULL),
	(156, 'MX', 'MEX', 484, 'MX', 'Mexico', 'Mexico City', 1972550, 109955000, 'NA', '.mx', 'MXN', 'Peso', '52', '#####', '^(d{5})$', 'es-MX', 3996063, 'GT,US,BZ', '', '$', NULL, NULL),
	(157, 'MY', 'MYS', 458, 'MY', 'Malaysia', 'Kuala Lumpur', 329750, 25259000, 'AS', '.my', 'MYR', 'Ringgit', '60', '#####', '^(d{5})$', 'ms-MY,en,zh,ta,te,ml,pa,th', 1733045, 'BN,TH,ID', '', 'RM', NULL, NULL),
	(158, 'MZ', 'MOZ', 508, 'MZ', 'Mozambique', 'Maputo', 801590, 21284000, 'AF', '.mz', 'MZN', 'Meticail', '258', '####', '^(d{4})$', 'pt-MZ,vmw', 1036973, 'ZW,TZ,SZ,ZA,ZM,MW', '', 'MT', NULL, NULL),
	(159, 'NA', 'NAM', 516, 'WA', 'Namibia', 'Windhoek', 825418, 2063000, 'AF', '.na', 'NAD', 'Dollar', '264', '', '', 'en-NA,af,de,hz,naq', 3355338, 'ZA,BW,ZM,AO', '', '$', NULL, NULL),
	(160, 'NC', 'NCL', 540, 'NC', 'New Caledonia', 'Nouméa', 19060, 216494, 'OC', '.nc', 'XPF', 'Franc', '687', '#####', '^(d{5})$', 'fr-NC', 2139685, '', '', NULL, NULL, NULL),
	(161, 'NE', 'NER', 562, 'NG', 'Niger', 'Niamey', 1267000, 13272000, 'AF', '.ne', 'XOF', 'Franc', '227', '####', '^(d{4})$', 'fr-NE,ha,kr,dje', 2440476, 'TD,BJ,DZ,LY,BF,NG,ML', '', NULL, NULL, NULL),
	(162, 'NF', 'NFK', 574, 'NF', 'Norfolk Island', 'Kingston', 35, 1828, 'OC', '.nf', 'AUD', 'Dollar', '672', '', '', 'en-NF', 2155115, '', '', '$', NULL, NULL),
	(163, 'NG', 'NGA', 566, 'NI', 'Nigeria', 'Abuja', 923768, 138283000, 'AF', '.ng', 'NGN', 'Naira', '234', '######', '^(d{6})$', 'en-NG,ha,yo,ig,ff', 2328926, 'TD,NE,BJ,CM', '', '₦', NULL, NULL),
	(164, 'NI', 'NIC', 558, 'NU', 'Nicaragua', 'Managua', 129494, 5780000, 'NA', '.ni', 'NIO', 'Cordoba', '505', '###-###-#', '^(d{7})$', 'es-NI,en', 3617476, 'CR,HN', '', 'C$', NULL, NULL),
	(165, 'NL', 'NLD', 528, 'NL', 'Netherlands', 'Amsterdam', 41526, 16645000, 'EU', '.nl', 'EUR', 'Euro', '31', '#### @@', '^(d{4}[A-Z]{2})$', 'nl-NL,fy-NL', 2750405, 'DE,BE', '', '€', NULL, NULL),
	(166, 'NO', 'NOR', 578, 'NO', 'Norway', 'Oslo', 324220, 4644000, 'EU', '.no', 'NOK', 'Krone', '47', '####', '^(d{4})$', 'no,nb,nn', 3144096, 'FI,RU,SE', '', 'kr', NULL, NULL),
	(167, 'NP', 'NPL', 524, 'NP', 'Nepal', 'Kathmandu', 140800, 29519000, 'AS', '.np', 'NPR', 'Rupee', '977', '#####', '^(d{5})$', 'ne,en', 1282988, 'CN,IN', '', '₨', NULL, NULL),
	(168, 'NR', 'NRU', 520, 'NR', 'Nauru', 'Yaren', 21, 13000, 'OC', '.nr', 'AUD', 'Dollar', '674', '', '', 'na,en-NR', 2110425, '', '', '$', NULL, NULL),
	(169, 'NU', 'NIU', 570, 'NE', 'Niue', 'Alofi', 260, 2166, 'OC', '.nu', 'NZD', 'Dollar', '683', '', '', 'niu,en-NU', 4036232, '', '', '$', NULL, NULL),
	(170, 'NZ', 'NZL', 554, 'NZ', 'New Zealand', 'Wellington', 268680, 4154000, 'OC', '.nz', 'NZD', 'Dollar', '64', '####', '^(d{4})$', 'en-NZ,mi', 2186224, '', '', '$', NULL, NULL),
	(171, 'OM', 'OMN', 512, 'MU', 'Oman', 'Muscat', 212460, 3309000, 'AS', '.om', 'OMR', 'Rial', '968', '###', '^(d{3})$', 'ar-OM,en,bal,ur', 286963, 'SA,YE,AE', '', '﷼', NULL, NULL),
	(172, 'PA', 'PAN', 591, 'PM', 'Panama', 'Panama City', 78200, 3292000, 'NA', '.pa', 'PAB', 'Balboa', '507', '', '', 'es-PA,en', 3703430, 'CR,CO', '', 'B/.', NULL, NULL),
	(173, 'PE', 'PER', 604, 'PE', 'Peru', 'Lima', 1285220, 29041000, 'SA', '.pe', 'PEN', 'Sol', '51', '', '', 'es-PE,qu,ay', 3932488, 'EC,CL,BO,BR,CO', '', 'S/.', NULL, NULL),
	(174, 'PF', 'PYF', 258, 'FP', 'French Polynesia', 'Papeete', 4167, 270485, 'OC', '.pf', 'XPF', 'Franc', '689', '#####', '^((97)|(98)7d{2})$', 'fr-PF,ty', 4020092, '', '', NULL, NULL, NULL),
	(175, 'PG', 'PNG', 598, 'PP', 'Papua New Guinea', 'Port Moresby', 462840, 5921000, 'OC', '.pg', 'PGK', 'Kina', '675', '###', '^(d{3})$', 'en-PG,ho,meu,tpi', 2088628, 'ID', '', NULL, NULL, NULL),
	(176, 'PH', 'PHL', 608, 'RP', 'Philippines', 'Manila', 300000, 92681000, 'AS', '.ph', 'PHP', 'Peso', '63', '####', '^(d{4})$', 'tl,en-PH,fil', 1694008, '', '', 'Php', NULL, NULL),
	(177, 'PK', 'PAK', 586, 'PK', 'Pakistan', 'Islamabad', 803940, 167762000, 'AS', '.pk', 'PKR', 'Rupee', '92', '#####', '^(d{5})$', 'ur-PK,en-PK,pa,sd,ps,brh', 1168579, 'CN,AF,IR,IN', '', '₨', NULL, NULL),
	(178, 'PL', 'POL', 616, 'PL', 'Poland', 'Warsaw', 312685, 38500000, 'EU', '.pl', 'PLN', 'Zloty', '48', '##-###', '^(d{5})$', 'pl', 798544, 'DE,LT,SK,CZ,BY,UA,RU', '', 'zł', NULL, NULL),
	(179, 'PM', 'SPM', 666, 'SB', 'Saint Pierre and Miquelon', 'Saint-Pierre', 242, 7012, 'NA', '.pm', 'EUR', 'Euro', '508', '', '', 'fr-PM', 3424932, '', '', '€', NULL, NULL),
	(180, 'PN', 'PCN', 612, 'PC', 'Pitcairn', 'Adamstown', 47, 46, 'OC', '.pn', 'NZD', 'Dollar', '', '', '', 'en-PN', 4030699, '', '', '$', NULL, NULL),
	(181, 'PR', 'PRI', 630, 'RQ', 'Puerto Rico', 'San Juan', 9104, 3916632, 'NA', '.pr', 'USD', 'Dollar', '+1-787 and 1-939', '#####-####', '^(d{9})$', 'en-PR,es-PR', 4566966, '', '', '$', NULL, NULL),
	(182, 'PS', 'PSE', 275, 'WE', 'Palestinian Territory', 'East Jerusalem', 5970, 3800000, 'AS', '.ps', 'ILS', 'Shekel', '970', '', '', 'ar-PS', 6254930, 'JO,IL', '', '₪', NULL, NULL),
	(183, 'PT', 'PRT', 620, 'PO', 'Portugal', 'Lisbon', 92391, 10676000, 'EU', '.pt', 'EUR', 'Euro', '351', '####-###', '^(d{7})$', 'pt-PT,mwl', 2264397, 'ES', '', '€', NULL, NULL),
	(184, 'PW', 'PLW', 585, 'PS', 'Palau', 'Koror', 458, 20303, 'OC', '.pw', 'USD', 'Dollar', '680', '96940', '^(96940)$', 'pau,sov,en-PW,tox,ja,fil,zh', 1559582, '', '', '$', NULL, NULL),
	(185, 'PY', 'PRY', 600, 'PA', 'Paraguay', 'Asunción', 406750, 6831000, 'SA', '.py', 'PYG', 'Guarani', '595', '####', '^(d{4})$', 'es-PY,gn', 3437598, 'BO,BR,AR', '', 'Gs', NULL, NULL),
	(186, 'QA', 'QAT', 634, 'QA', 'Qatar', 'Doha', 11437, 928000, 'AS', '.qa', 'QAR', 'Rial', '974', '', '', 'ar-QA,es', 289688, 'SA', '', '﷼', NULL, NULL),
	(187, 'RE', 'REU', 638, 'RE', 'Reunion', 'Saint-Denis', 2517, 776948, 'AF', '.re', 'EUR', 'Euro', '262', '#####', '^((97)|(98)(4|7|8)d{2})$', 'fr-RE', 935317, '', '', '€', NULL, NULL),
	(188, 'RO', 'ROU', 642, 'RO', 'Romania', 'Bucharest', 237500, 22246000, 'EU', '.ro', 'RON', 'Leu', '40', '######', '^(d{6})$', 'ro,hu,rom', 798549, 'MD,HU,UA,CS,BG,RS', '', 'lei', NULL, NULL),
	(189, 'RS', 'SRB', 688, 'RB', 'Serbia', 'Belgrade', 88361, 10159000, 'EU', '.rs', 'RSD', 'Dinar', '381', '######', '^(d{6})$', 'sr,hu,bs,rom', 6290252, 'AL,HU,MK,RO,HR,BA,BG,ME', '', 'Дин', NULL, NULL),
	(190, 'RU', 'RUS', 643, 'RS', 'Russia', 'Moscow', 17100000, 140702000, 'EU', '.ru', 'RUB', 'Ruble', '7', '######', '^(d{6})$', 'ru-RU', 2017370, 'GE,CN,BY,UA,KZ,LV,PL,EE,LT,FI,MN,NO,AZ,KP', '', 'руб', NULL, NULL),
	(191, 'RW', 'RWA', 646, 'RW', 'Rwanda', 'Kigali', 26338, 10186000, 'AF', '.rw', 'RWF', 'Franc', '250', '', '', 'rw,en-RW,fr-RW,sw', 49518, 'TZ,CD,BI,UG', '', NULL, NULL, NULL),
	(192, 'SA', 'SAU', 682, 'SA', 'Saudi Arabia', 'Riyadh', 1960582, 28161000, 'AS', '.sa', 'SAR', 'Rial', '966', '#####', '^(d{5})$', 'ar-SA', 102358, 'QA,OM,IQ,YE,JO,AE,KW', '', '﷼', NULL, NULL),
	(193, 'SB', 'SLB', 90, 'BP', 'Solomon Islands', 'Honiara', 28450, 581000, 'OC', '.sb', 'SBD', 'Dollar', '677', '', '', 'en-SB,tpi', 2103350, '', '', '$', NULL, NULL),
	(194, 'SC', 'SYC', 690, 'SE', 'Seychelles', 'Victoria', 455, 82000, 'AF', '.sc', 'SCR', 'Rupee', '248', '', '', 'en-SC,fr-SC', 241170, '', '', '₨', NULL, NULL),
	(195, 'SD', 'SDN', 736, 'SU', 'Sudan', 'Khartoum', 2505810, 40218000, 'AF', '.sd', 'SDD', 'Dinar', '249', '#####', '^(d{5})$', 'ar-SD,en,fia', 366755, 'TD,ER,ET,LY,KE,CF,CD,UG,EG', '', NULL, NULL, NULL),
	(196, 'SE', 'SWE', 752, 'SW', 'Sweden', 'Stockholm', 449964, 9045000, 'EU', '.se', 'SEK', 'Krona', '46', 'SE-### ##', '^(?:SE)*(d{5})$', 'sv-SE,se,sma,fi-SE', 2661886, 'NO,FI', '', 'kr', NULL, NULL),
	(197, 'SG', 'SGP', 702, 'SN', 'Singapore', 'Singapur', 693, 4608000, 'AS', '.sg', 'SGD', 'Dollar', '65', '######', '^(d{6})$', 'cmn,en-SG,ms-SG,ta-SG,zh-SG', 1880251, '', '', '$', NULL, NULL),
	(198, 'SH', 'SHN', 654, 'SH', 'Saint Helena', 'Jamestown', 410, 7460, 'AF', '.sh', 'SHP', 'Pound', '290', 'STHL 1ZZ', '^(STHL1ZZ)$', 'en-SH', 3370751, '', '', '£', NULL, NULL),
	(199, 'SI', 'SVN', 705, 'SI', 'Slovenia', 'Ljubljana', 20273, 2007000, 'EU', '.si', 'EUR', 'Euro', '386', 'SI- ####', '^(?:SI)*(d{4})$', 'sl,sh', 3190538, 'HU,IT,HR,AT', '', '€', NULL, NULL),
	(200, 'SJ', 'SJM', 744, 'SV', 'Svalbard and Jan Mayen', 'Longyearbyen', 62049, 2265, 'EU', '.sj', 'NOK', 'Krone', '47', '', '', 'no,ru', 607072, '', '', 'kr', NULL, NULL),
	(201, 'SK', 'SVK', 703, 'LO', 'Slovakia', 'Bratislava', 48845, 5455000, 'EU', '.sk', 'SKK', 'Koruna', '421', '###  ##', '^(d{5})$', 'sk,hu', 3057568, 'PL,HU,CZ,UA,AT', '', 'Sk', NULL, NULL),
	(202, 'SL', 'SLE', 694, 'SL', 'Sierra Leone', 'Freetown', 71740, 6286000, 'AF', '.sl', 'SLL', 'Leone', '232', '', '', 'en-SL,men,tem', 2403846, 'LR,GN', '', 'Le', NULL, NULL),
	(203, 'SM', 'SMR', 674, 'SM', 'San Marino', 'San Marino', 61, 29000, 'EU', '.sm', 'EUR', 'Euro', '378', '4789#', '^(4789d)$', 'it-SM', 3168068, 'IT', '', '€', NULL, NULL),
	(204, 'SN', 'SEN', 686, 'SG', 'Senegal', 'Dakar', 196190, 12853000, 'AF', '.sn', 'XOF', 'Franc', '221', '#####', '^(d{5})$', 'fr-SN,wo,fuc,mnk', 2245662, 'GN,MR,GW,GM,ML', '', NULL, NULL, NULL),
	(205, 'SO', 'SOM', 706, 'SO', 'Somalia', 'Mogadishu', 637657, 9379000, 'AF', '.so', 'SOS', 'Shilling', '252', '@@  #####', '^([A-Z]{2}d{5})$', 'so-SO,ar-SO,it,en-SO', 51537, 'ET,KE,DJ', '', 'S', NULL, NULL),
	(206, 'SR', 'SUR', 740, 'NS', 'Suriname', 'Paramaribo', 163270, 475000, 'SA', '.sr', 'SRD', 'Dollar', '597', '', '', 'nl-SR,en,srn,hns,jv', 3382998, 'GY,BR,GF', '', '$', NULL, NULL),
	(207, 'ST', 'STP', 678, 'TP', 'Sao Tome and Principe', 'São Tomé', 1001, 205000, 'AF', '.st', 'STD', 'Dobra', '239', '', '', 'pt-ST', 2410758, '', '', 'Db', NULL, NULL),
	(208, 'SV', 'SLV', 222, 'ES', 'El Salvador', 'San Salvador', 21040, 7066000, 'NA', '.sv', 'SVC', 'Colone', '503', 'CP ####', '^(?:CP)*(d{4})$', 'es-SV', 3585968, 'GT,HN', '', '$', NULL, NULL),
	(209, 'SY', 'SYR', 760, 'SY', 'Syria', 'Damascus', 185180, 19747000, 'AS', '.sy', 'SYP', 'Pound', '963', '', '', 'ar-SY,ku,hy,arc,fr,en', 163843, 'IQ,JO,IL,TR,LB', '', '£', NULL, NULL),
	(210, 'SZ', 'SWZ', 748, 'WZ', 'Swaziland', 'Mbabane', 17363, 1128000, 'AF', '.sz', 'SZL', 'Lilangeni', '268', '@###', '^([A-Z]d{3})$', 'en-SZ,ss-SZ', 934841, 'ZA,MZ', '', NULL, NULL, NULL),
	(211, 'TC', 'TCA', 796, 'TK', 'Turks and Caicos Islands', 'Cockburn Town', 430, 20556, 'NA', '.tc', 'USD', 'Dollar', '+1-649', 'TKCA 1ZZ', '^(TKCA 1ZZ)$', 'en-TC', 3576916, '', '', '$', NULL, NULL),
	(212, 'TD', 'TCD', 148, 'CD', 'Chad', 'N\'Djamena', 1284000, 10111000, 'AF', '.td', 'XAF', 'Franc', '235', '', '', 'fr-TD,ar-TD,sre', 2434508, 'NE,LY,CF,SD,CM,NG', '', NULL, NULL, NULL),
	(213, 'TF', 'ATF', 260, 'FS', 'French Southern Territories', 'Martin-de-Viviès', 7829, 0, 'AN', '.tf', 'EUR', 'Euro  ', '', '', '', 'fr', 1546748, '', '', '€', NULL, NULL),
	(214, 'TG', 'TGO', 768, 'TO', 'Togo', 'Lomé', 56785, 5858000, 'AF', '.tg', 'XOF', 'Franc', '228', '', '', 'fr-TG,ee,hna,kbp,dag,ha', 2363686, 'BJ,GH,BF', '', NULL, NULL, NULL),
	(215, 'TH', 'THA', 764, 'TH', 'Thailand', 'Bangkok', 514000, 65493000, 'AS', '.th', 'THB', 'Baht', '66', '#####', '^(d{5})$', 'th,en', 1605651, 'LA,MM,KH,MY', '', '฿', NULL, NULL),
	(216, 'TJ', 'TJK', 762, 'TI', 'Tajikistan', 'Dushanbe', 143100, 7211000, 'AS', '.tj', 'TJS', 'Somoni', '992', '######', '^(d{6})$', 'tg,ru', 1220409, 'CN,AF,KG,UZ', '', NULL, NULL, NULL),
	(217, 'TK', 'TKL', 772, 'TL', 'Tokelau', '', 10, 1405, 'OC', '.tk', 'NZD', 'Dollar', '690', '', '', 'tkl,en-TK', 4031074, '', '', '$', NULL, NULL),
	(218, 'TL', 'TLS', 626, 'TT', 'East Timor', 'Dili', 15007, 1107000, 'OC', '.tp', 'USD', 'Dollar', '670', '', '', 'tet,pt-TL,id,en', 1966436, 'ID', '', '$', NULL, NULL),
	(219, 'TM', 'TKM', 795, 'TX', 'Turkmenistan', 'Ashgabat', 488100, 5179000, 'AS', '.tm', 'TMM', 'Manat', '993', '######', '^(d{6})$', 'tk,ru,uz', 1218197, 'AF,IR,UZ,KZ', '', 'm', NULL, NULL),
	(220, 'TN', 'TUN', 788, 'TS', 'Tunisia', 'Tunis', 163610, 10378000, 'AF', '.tn', 'TND', 'Dinar', '216', '####', '^(d{4})$', 'ar-TN,fr', 2464461, 'DZ,LY', '', NULL, NULL, NULL),
	(221, 'TO', 'TON', 776, 'TN', 'Tonga', 'Nuku\'alofa', 748, 118000, 'OC', '.to', 'TOP', 'Pa\'anga', '676', '', '', 'to,en-TO', 4032283, '', '', 'T$', NULL, NULL),
	(222, 'TR', 'TUR', 792, 'TU', 'Turkey', 'Ankara', 780580, 71892000, 'AS', '.tr', 'TRY', 'Lira', '90', '#####', '^(d{5})$', 'tr-TR,ku,diq,az,av', 298795, 'SY,GE,IQ,IR,GR,AM,AZ,BG', '', 'YTL', NULL, NULL),
	(223, 'TT', 'TTO', 780, 'TD', 'Trinidad and Tobago', 'Port of Spain', 5128, 1047000, 'NA', '.tt', 'TTD', 'Dollar', '+1-868', '', '', 'en-TT,hns,fr,es,zh', 3573591, '', '', 'TT$', NULL, NULL),
	(224, 'TV', 'TUV', 798, 'TV', 'Tuvalu', 'Vaiaku', 26, 12000, 'OC', '.tv', 'AUD', 'Dollar', '688', '', '', 'tvl,en,sm,gil', 2110297, '', '', '$', NULL, NULL),
	(225, 'TW', 'TWN', 158, 'TW', 'Taiwan', 'Taipei', 35980, 22894384, 'AS', '.tw', 'TWD', 'Dollar', '886', '#####', '^(d{5})$', 'zh-TW,zh,nan,hak', 1668284, '', '', 'NT$', NULL, NULL),
	(226, 'TZ', 'TZA', 834, 'TZ', 'Tanzania', 'Dar es Salaam', 945087, 40213000, 'AF', '.tz', 'TZS', 'Shilling', '255', '', '', 'sw-TZ,en,ar', 149590, 'MZ,KE,CD,RW,ZM,BI,UG,MW', '', NULL, NULL, NULL),
	(227, 'UA', 'UKR', 804, 'UP', 'Ukraine', 'Kiev', 603700, 45994000, 'EU', '.ua', 'UAH', 'Hryvnia', '380', '#####', '^(d{5})$', 'uk,ru-UA,rom,pl,hu', 690791, 'PL,MD,HU,SK,BY,RO,RU', '', '₴', NULL, NULL),
	(228, 'UG', 'UGA', 800, 'UG', 'Uganda', 'Kampala', 236040, 31367000, 'AF', '.ug', 'UGX', 'Shilling', '256', '', '', 'en-UG,lg,sw,ar', 226074, 'TZ,KE,SD,CD,RW', '', NULL, NULL, NULL),
	(229, 'UM', 'UMI', 581, '', 'United States Minor Outlying Islands', '', 0, 0, 'OC', '.um', 'USD', 'Dollar ', '', '', '', 'en-UM', 5854968, '', '', '$', NULL, NULL),
	(230, 'US', 'USA', 840, 'US', 'United States', 'Washington', 9629091, 303824000, 'NA', '.us', 'USD', 'Dollar', '1', '#####-####', '^(d{9})$', 'en-US,es-US,haw', 6252001, 'CA,MX,CU', '', '$', NULL, NULL),
	(231, 'UY', 'URY', 858, 'UY', 'Uruguay', 'Montevideo', 176220, 3477000, 'SA', '.uy', 'UYU', 'Peso', '598', '#####', '^(d{5})$', 'es-UY', 3439705, 'BR,AR', '', '$U', NULL, NULL),
	(232, 'UZ', 'UZB', 860, 'UZ', 'Uzbekistan', 'Tashkent', 447400, 28268000, 'AS', '.uz', 'UZS', 'Som', '998', '######', '^(d{6})$', 'uz,ru,tg', 1512440, 'TM,AF,KG,TJ,KZ', '', 'лв', NULL, NULL),
	(233, 'VA', 'VAT', 336, 'VT', 'Vatican', 'Vatican City', 0, 921, 'EU', '.va', 'EUR', 'Euro', '379', '', '', 'la,it,fr', 3164670, 'IT', '', '€', NULL, NULL),
	(234, 'VC', 'VCT', 670, 'VC', 'Saint Vincent and the Grenadines', 'Kingstown', 389, 117534, 'NA', '.vc', 'XCD', 'Dollar', '+1-784', '', '', 'en-VC,fr', 3577815, '', '', '$', NULL, NULL),
	(235, 'VE', 'VEN', 862, 'VE', 'Venezuela', 'Caracas', 912050, 26414000, 'SA', '.ve', 'VEF', 'Bolivar', '58', '####', '^(d{4})$', 'es-VE', 3625428, 'GY,BR,CO', '', 'Bs', NULL, NULL),
	(236, 'VG', 'VGB', 92, 'VI', 'British Virgin Islands', 'Road Town', 153, 21730, 'NA', '.vg', 'USD', 'Dollar', '+1-284', '', '', 'en-VG', 3577718, '', '', '$', NULL, NULL),
	(237, 'VI', 'VIR', 850, 'VQ', 'U.S. Virgin Islands', 'Charlotte Amalie', 352, 108708, 'NA', '.vi', 'USD', 'Dollar', '+1-340', '', '', 'en-VI', 4796775, '', '', '$', NULL, NULL),
	(238, 'VN', 'VNM', 704, 'VM', 'Vietnam', 'Hanoi', 329560, 86116000, 'AS', '.vn', 'VND', 'Dong', '84', '######', '^(d{6})$', 'vi,en,fr,zh,km', 1562822, 'CN,LA,KH', '', '₫', NULL, NULL),
	(239, 'VU', 'VUT', 548, 'NH', 'Vanuatu', 'Port Vila', 12200, 215000, 'OC', '.vu', 'VUV', 'Vatu', '678', '', '', 'bi,en-VU,fr-VU', 2134431, '', '', 'Vt', NULL, NULL),
	(240, 'WF', 'WLF', 876, 'WF', 'Wallis and Futuna', 'MatÃ¢\'Utu', 274, 16025, 'OC', '.wf', 'XPF', 'Franc', '681', '', '', 'wls,fud,fr-WF', 4034749, '', '', NULL, NULL, NULL),
	(241, 'WS', 'WSM', 882, 'WS', 'Samoa', 'Apia', 2944, 217000, 'OC', '.ws', 'WST', 'Tala', '685', '', '', 'sm,en-WS', 4034894, '', '', 'WS$', NULL, NULL),
	(242, 'YE', 'YEM', 887, 'YM', 'Yemen', 'San?a?', 527970, 23013000, 'AS', '.ye', 'YER', 'Rial', '967', '', '', 'ar-YE', 69543, 'SA,OM', '', '﷼', NULL, NULL),
	(243, 'YT', 'MYT', 175, 'MF', 'Mayotte', 'Mamoudzou', 374, 159042, 'AF', '.yt', 'EUR', 'Euro', '269', '#####', '^(d{5})$', 'fr-YT', 1024031, '', '', '€', NULL, NULL),
	(244, 'ZA', 'ZAF', 710, 'SF', 'South Africa', 'Pretoria', 1219912, 43786000, 'AF', '.za', 'ZAR', 'Rand', '27', '####', '^(d{4})$', 'zu,xh,af,nso,en-ZA,tn,st,ts', 953987, 'ZW,SZ,MZ,BW,NA,LS', '', 'R', NULL, NULL),
	(245, 'ZM', 'ZMB', 894, 'ZA', 'Zambia', 'Lusaka', 752614, 11669000, 'AF', '.zm', 'ZMK', 'Kwacha', '260', '#####', '^(d{5})$', 'en-ZM,bem,loz,lun,lue,ny,toi', 895949, 'ZW,TZ,MZ,CD,NA,MW,AO', '', 'ZK', NULL, NULL),
	(246, 'ZW', 'ZWE', 716, 'ZI', 'Zimbabwe', 'Harare', 390580, 12382000, 'AF', '.zw', 'ZWD', 'Dollar', '263', '', '', 'en-ZW,sn,nr,nd', 878675, 'ZA,MZ,BW,ZM', '', 'Z$', NULL, NULL),
	(247, 'CS', 'SCG', 891, 'YI', 'Serbia and Montenegro', 'Belgrade', 102350, 10829175, 'EU', '.cs', 'RSD', 'Dinar', '+381', '#####', '^(d{5})$', 'cu,hu,sq,sr', 863038, 'AL,HU,MK,RO,HR,BA,BG', '', 'Дин', NULL, NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_freebies: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_freebies` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_freebies` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_freebie_models: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_freebie_models` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_freebie_models` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_freebie_periods: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_freebie_periods` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_freebie_periods` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_packages: ~4 rows (approximately)
/*!40000 ALTER TABLE `discount_packages` DISABLE KEYS */;
INSERT INTO `discount_packages` (`id`, `name`, `discount_amount`, `discount_type`, `booking_duration`, `booking_duration_type`, `discount_package_type`, `status`, `description`, `created_at`, `updated_at`, `featured`) VALUES
	(13, '30%', 30.00, 'percent', 14, 'days', 'selected', 1, '<p>FREE EXCLUSIVE PEN</p>', '2017-08-02 17:30:34', '2017-08-10 11:55:40', 1),
	(14, '20 %', 20.00, 'percent', 7, 'days', 'selected', 1, '<p>FREE EXCLUSIVE PEN</p>', '2017-08-08 12:29:55', '2017-08-10 11:55:29', 1),
	(15, '50%', 50.00, 'percent', 30, 'days', 'selected', 1, '<p>FREE EXCLUSIVE PEN</p>', '2017-08-10 11:03:33', '2017-08-10 11:43:58', 1),
	(16, '5', 5.00, 'percent', 2, 'days', 'selected', 1, '<p>FREE EXCLUSIVE PEN</p>', '2017-08-10 11:58:46', '2017-08-10 11:58:52', 1);
/*!40000 ALTER TABLE `discount_packages` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_package_models: ~18 rows (approximately)
/*!40000 ALTER TABLE `discount_package_models` DISABLE KEYS */;
INSERT INTO `discount_package_models` (`discount_package_id`, `model_id`) VALUES
	(13, 1),
	(14, 3),
	(15, 2),
	(15, 1),
	(15, 3),
	(15, 17),
	(15, 12),
	(14, 2),
	(14, 1),
	(14, 17),
	(14, 12),
	(13, 2),
	(13, 3),
	(13, 17),
	(13, 12),
	(16, 1),
	(16, 2),
	(16, 3);
/*!40000 ALTER TABLE `discount_package_models` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_package_periods: ~3 rows (approximately)
/*!40000 ALTER TABLE `discount_package_periods` DISABLE KEYS */;
INSERT INTO `discount_package_periods` (`discount_package_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
	(14, '2017-08-01 00:00:00', '2018-08-31 00:00:00', '2017-08-10 11:55:29', '2017-08-10 11:55:29'),
	(13, '2017-08-01 00:00:00', '2018-08-31 00:00:00', '2017-08-10 11:55:40', '2017-08-10 11:55:40'),
	(15, '2017-08-01 00:00:00', '2018-08-31 00:00:00', '2017-08-10 11:56:13', '2017-08-10 11:56:13'),
	(16, '2017-08-01 00:00:00', '2018-04-19 00:00:00', '2017-09-04 08:15:57', '2017-09-04 08:15:57');
/*!40000 ALTER TABLE `discount_package_periods` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_vouchers: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_vouchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_vouchers` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_voucher_car_models_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_voucher_car_models_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_voucher_car_models_types` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_voucher_recurring_rules: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_voucher_recurring_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_voucher_recurring_rules` ENABLE KEYS */;

-- Dumping data for table ebdb.discount_voucher_recurring_rule_repititions: ~0 rows (approximately)
/*!40000 ALTER TABLE `discount_voucher_recurring_rule_repititions` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_voucher_recurring_rule_repititions` ENABLE KEYS */;

-- Dumping data for table ebdb.email_notification_templates: ~6 rows (approximately)
/*!40000 ALTER TABLE `email_notification_templates` DISABLE KEYS */;
INSERT INTO `email_notification_templates` (`id`, `name`, `email_body`, `notify_event`, `created_at`, `updated_at`) VALUES
	(1, 'Reservation confirmation', '<p>Hi {notification:name},</p>\r\n\r\n<p>Your booking with the total amount of&nbsp;{notification:total} is confirmed.</p>\r\n\r\n<p>Thank you.</p>\r\n\r\n<p>Best regards,</p>\r\n\r\n<p>&nbsp;</p>', 'NewReservationCustomer', NULL, '2017-07-13 09:57:16'),
	(2, 'Reservation confirmation', '<p>Hi {notification:name},</p>\r\n\r\n<p>Your booking with the total amount of {notification:total} is confirmed.</p>\r\n\r\n<p>Thank you.</p>\r\n\r\n<p>Best regards,</p>', 'NewReservationAdmin', NULL, '2017-07-14 15:28:34'),
	(3, 'Payment confirmation', '', 'PaymentConfirmationCustomer', NULL, NULL),
	(4, 'Payment confirmation', '', 'PaymentConfirmationAdmin', NULL, NULL),
	(5, 'Cancellation Email', '', 'CancellationEmailCustomer', NULL, NULL),
	(6, 'Cancellation Email', '', 'CancellationEmailAdmin', NULL, NULL);
/*!40000 ALTER TABLE `email_notification_templates` ENABLE KEYS */;

-- Dumping data for table ebdb.fleet_types: ~8 rows (approximately)
/*!40000 ALTER TABLE `fleet_types` DISABLE KEYS */;
INSERT INTO `fleet_types` (`id`, `sipp_code_one`, `sipp_code_two`, `sipp_code_three`, `sipp_code_four`, `created_at`, `updated_at`) VALUES
	(1, 5, 20, 43, 60, '2017-07-04 20:12:34', '2017-07-31 12:14:42'),
	(2, 3, 20, 43, 60, '2017-07-13 10:11:19', '2017-07-13 10:11:19'),
	(3, 15, 20, 43, 48, '2017-07-13 10:14:23', '2017-07-13 10:14:23'),
	(4, 11, 21, 43, 60, '2017-07-13 10:17:24', '2017-07-31 12:14:28'),
	(5, 9, 20, 43, 60, '2017-07-31 12:14:04', '2017-07-31 12:14:04'),
	(6, 13, 20, 43, 60, '2017-08-02 02:22:37', '2017-08-02 02:22:37'),
	(7, 12, 21, 43, 48, '2017-08-02 05:11:55', '2017-08-02 05:11:55'),
	(8, 7, 20, 43, 60, '2017-08-02 05:13:40', '2017-08-02 05:13:40');
/*!40000 ALTER TABLE `fleet_types` ENABLE KEYS */;

-- Dumping data for table ebdb.migrations: ~34 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(286, '2014_10_12_000000_create_users_table', 1),
	(287, '2014_10_12_100000_create_password_resets_table', 1),
	(288, '2016_03_09_112748_create_countries_table', 1),
	(289, '2016_03_22_163433_creat_sipp_codes_table', 1),
	(290, '2017_02_21_171816_entrust_setup_tables', 1),
	(291, '2017_02_22_170917_create_car_models_table', 1),
	(292, '2017_02_22_170938_create_car_model_prices_table', 1),
	(293, '2017_02_24_193655_create_car_extras_table', 1),
	(294, '2017_02_24_193719_create_car_model_extras_table', 1),
	(295, '2017_02_24_213715_create_office_locations_table', 1),
	(296, '2017_02_25_000609_create_office_location_working_time_table', 1),
	(297, '2017_02_25_003419_create_office_location_custom_working_time_table', 1),
	(298, '2017_02_25_173513_create_rental_cars_table', 1),
	(299, '2017_02_26_183701_create_settings_table', 1),
	(300, '2017_03_07_121958_create_discount_vouchers_table', 1),
	(301, '2017_03_07_165253_create_voucher_recurring_rules_table', 1),
	(302, '2017_03_07_165332_create_voucher_recurring_repititions_table', 1),
	(303, '2017_03_08_190545_create_discount_voucher_car_models_table', 1),
	(304, '2017_03_14_183255_create_packages_table', 1),
	(305, '2017_03_14_183335_create_package_models_table', 1),
	(306, '2017_03_15_053634_create_email_notifications_table', 1),
	(307, '2017_03_15_174748_create_freebies_table', 1),
	(308, '2017_03_22_043621_create_freebie_models_table', 1),
	(309, '2017_03_22_043621_create_freebie_periods_table', 1),
	(310, '2017_03_31_213454_create_types_table', 1),
	(311, '2017_04_04_161120_create_car_reservations_table', 1),
	(312, '2017_04_04_162426_create_pakage_periods_table', 1),
	(313, '2017_04_04_171320_create_car_reservation_details_table', 1),
	(314, '2017_04_04_193511_create_car_reservation_extras_table', 1),
	(315, '2017_04_05_081121_create_rental_car_reservation_payments_table', 1),
	(316, '2017_04_09_174503_create_rental_car_types_table', 1),
	(317, '2017_06_17_100317_add_featured_to_discount_vouchers', 1),
	(318, '2017_06_17_100335_add_featured_to_discount_freebies', 1),
	(319, '2017_06_17_100349_add_featured_to_discount_packages', 1),
	(320, '2017_07_29_130733_add_freebies_col_to_reservations', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table ebdb.office_locations: ~1 rows (approximately)
/*!40000 ALTER TABLE `office_locations` DISABLE KEYS */;
INSERT INTO `office_locations` (`id`, `name`, `email`, `state`, `city`, `address`, `country_id`, `zip`, `phone`, `lat`, `lng`, `notify_email`, `thumb_path`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Kerinchi LRT Station', 'info@embassyalliance.com', 'Jalan Pantai Bharu', 'Kuala Lumpur', 'Suite C-12-1, Wisma Goshen, Plaza Pantai, Jalan 4/83A, Off Jalan Pantai Bharu, 59200 Kuala Lumpur, Malaysia', 157, '50088', '+60322874722', '3.1151749', '101.668418', 1, NULL, 1, '2017-07-04 20:11:22', '2017-08-10 11:15:16');
/*!40000 ALTER TABLE `office_locations` ENABLE KEYS */;

-- Dumping data for table ebdb.office_location_custom_working_times: ~0 rows (approximately)
/*!40000 ALTER TABLE `office_location_custom_working_times` DISABLE KEYS */;
/*!40000 ALTER TABLE `office_location_custom_working_times` ENABLE KEYS */;

-- Dumping data for table ebdb.office_location_working_times: ~0 rows (approximately)
/*!40000 ALTER TABLE `office_location_working_times` DISABLE KEYS */;
INSERT INTO `office_location_working_times` (`id`, `monday_from`, `monday_to`, `monday_dayoff`, `tuesday_from`, `tuesday_to`, `tuesday_dayoff`, `wednesday_from`, `wednesday_to`, `wednesday_dayoff`, `thursday_from`, `thursday_to`, `thursday_dayoff`, `friday_from`, `friday_to`, `friday_dayoff`, `saturday_from`, `saturday_to`, `saturday_dayoff`, `sunday_from`, `sunday_to`, `sunday_dayoff`, `location_id`, `created_at`, `updated_at`) VALUES
	(1, '09:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, 1, '2017-07-04 20:11:54', '2017-08-10 11:15:16');
/*!40000 ALTER TABLE `office_location_working_times` ENABLE KEYS */;

-- Dumping data for table ebdb.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping data for table ebdb.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping data for table ebdb.permission_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping data for table ebdb.rental_cars: ~4 rows (approximately)
/*!40000 ALTER TABLE `rental_cars` DISABLE KEYS */;
INSERT INTO `rental_cars` (`id`, `url_token`, `registration_number`, `current_mileage`, `type_id`, `model_id`, `location_id`, `thumb_image`, `status`, `featured`, `created_at`, `updated_at`) VALUES
	(1, 'mitsubishi-attrage2016-542135138', '542135138', '14254', 2, 1, 1, '1502362047.jpg', 1, 1, '2017-07-04 20:16:42', '2017-08-14 09:14:04'),
	(2, 'perodua-bezza-premium-x-at-wtf007', 'WTF 007', '2000', 2, 2, 1, '1499943806.jpg', 1, 1, '2017-07-13 11:03:26', '2017-07-13 11:03:43'),
	(3, 'proton-saga-flx-7890', '7890', '0', 2, 3, 1, '1502367048.jpg', 1, 1, '2017-07-25 10:35:08', '2017-08-10 12:10:48'),
	(4, 'bmw-5series2-0-auto--2000', '2000', '0', 3, 17, 1, '1502366693.jpg', 1, 1, '2017-08-10 12:04:53', '2017-08-10 12:08:54');
/*!40000 ALTER TABLE `rental_cars` ENABLE KEYS */;

-- Dumping data for table ebdb.rental_car_reservations: ~2 rows (approximately)
/*!40000 ALTER TABLE `rental_car_reservations` DISABLE KEYS */;
INSERT INTO `rental_car_reservations` (`id`, `reservation_number`, `ip_address`, `user_id`, `processed_on`, `txn_id`, `status`, `payment_method`, `cc_type`, `cc_num`, `cc_exp`, `cc_code`, `created_at`, `updated_at`) VALUES
	(10, '1501904533562927', '172.31.7.127', 6, '2017-08-05 03:42:13', '', 'pending', 'cash', 'Visa', '123456789012', '06-20', '786', '2017-08-05 03:42:13', '2017-08-05 05:13:39');
/*!40000 ALTER TABLE `rental_car_reservations` ENABLE KEYS */;

-- Dumping data for table ebdb.rental_car_reservation_extras: ~0 rows (approximately)
/*!40000 ALTER TABLE `rental_car_reservation_extras` DISABLE KEYS */;
/*!40000 ALTER TABLE `rental_car_reservation_extras` ENABLE KEYS */;

-- Dumping data for table ebdb.rental_car_reservation_payments: ~2 rows (approximately)
/*!40000 ALTER TABLE `rental_car_reservation_payments` DISABLE KEYS */;
INSERT INTO `rental_car_reservation_payments` (`id`, `reservation_id`, `payment_method`, `payment_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES
	(2, 10, '', '', 0.00, 'paid', '2017-08-05 04:04:34', '2017-08-05 04:04:34'),
	(3, 10, '', '', 0.00, 'paid', '2017-08-05 04:04:37', '2017-08-05 04:04:37');
/*!40000 ALTER TABLE `rental_car_reservation_payments` ENABLE KEYS */;

-- Dumping data for table ebdb.rental_car_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `rental_car_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `rental_car_types` ENABLE KEYS */;

-- Dumping data for table ebdb.rental_settings: ~20 rows (approximately)
/*!40000 ALTER TABLE `rental_settings` DISABLE KEYS */;
INSERT INTO `rental_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'currency', 'MYR', '2017-07-04 15:15:30', '2017-08-10 11:17:17'),
	(2, 'mileage', 'km', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(3, 'week_start', '1', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(4, 'calculate_rental_fee', 'both', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(5, 'minimum_booking_length', '2', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(6, 'booking_pending', '1', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(7, 'rental_terms', 'Rental Terms and Conditions goes here', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(8, 'deposit_payment', '10', '2017-07-04 15:15:30', '2017-07-04 20:10:33'),
	(9, 'deposit_type', 'percent', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(10, 'tax_payment', '6', '2017-07-04 15:15:30', '2017-07-13 09:52:07'),
	(11, 'tax_type', 'percent', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(12, 'service_tax_payment', '0', '2017-07-04 15:15:30', '2017-07-13 12:00:28'),
	(13, 'service_tax_type', 'percent', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(14, 'security_payment', '0', '2017-07-04 15:15:30', '2017-07-13 12:00:28'),
	(15, 'insurance_payment', '0', '2017-07-04 15:15:30', '2017-07-13 12:00:28'),
	(16, 'insurance_type', 'percent', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(17, 'booking_status', 'pending', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(18, 'payment_disable', '0', '2017-07-04 15:15:30', '2017-07-04 15:15:30'),
	(19, 'allow_cash', '1', '2017-07-04 15:15:30', '2017-07-13 09:52:07'),
	(20, 'contact_us_notify', 'suzanne:suzanne@embassyalliance.com,michael:michael@embassyalliance.com', '2017-07-04 15:15:30', '2017-07-30 05:58:31'),
	(21, 'payment_status', 'confirmed', '2017-07-04 20:10:33', '2017-07-13 09:52:07'),
	(22, 'reservations_notify', 'suzanne:suzanne@embassyalliance.com,michael:michael@embassyalliance.com,idrees:medriis@gmail.com', '2017-07-04 20:10:33', '2017-07-30 05:58:31');
/*!40000 ALTER TABLE `rental_settings` ENABLE KEYS */;

-- Dumping data for table ebdb.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin', NULL, NULL, NULL, NULL),
	(2, 'editor', NULL, NULL, NULL, NULL),
	(3, 'customer', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping data for table ebdb.role_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(5, 1),
	(6, 3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Dumping data for table ebdb.sipp_codes: ~62 rows (approximately)
/*!40000 ALTER TABLE `sipp_codes` DISABLE KEYS */;
INSERT INTO `sipp_codes` (`id`, `code_letter`, `description`, `code_type`) VALUES
	(1, 'M', 'Mini', 'A'),
	(2, 'N', 'Mini Elite', 'A'),
	(3, 'E', 'Economy', 'A'),
	(4, 'H', 'Economy Elite', 'A'),
	(5, 'C', 'Compact', 'A'),
	(6, 'D', 'Compact Elite', 'A'),
	(7, 'I', 'Intermediate', 'A'),
	(8, 'J', 'Intermediate Elite', 'A'),
	(9, 'S', 'Standard', 'A'),
	(10, 'R', 'Standard Elite', 'A'),
	(11, 'F', 'Fullsize', 'A'),
	(12, 'G', 'Fullsize Elite', 'A'),
	(13, 'P', 'Premium', 'A'),
	(14, 'U', 'Premium Elite', 'A'),
	(15, 'L', 'Luxury', 'A'),
	(16, 'W', 'Luxury Elite', 'A'),
	(17, 'O', 'Oversize', 'A'),
	(18, 'X', 'Special', 'A'),
	(19, 'B', '2/3 door', 'B'),
	(20, 'C', '2/4 door', 'B'),
	(21, 'D', '4/5 door', 'B'),
	(22, 'W', 'Wagon / Estate', 'B'),
	(23, 'V', 'Passenger Van', 'B'),
	(24, 'L', 'Limousine', 'B'),
	(25, 'S', 'Sport', 'B'),
	(26, 'T', 'Convertable', 'B'),
	(27, 'J', 'Open Air All Terrain', 'B'),
	(28, 'X', 'Special', 'B'),
	(29, 'P', 'Pickup Regular Cab', 'B'),
	(30, 'Q', 'Pickup Extended Cab', 'B'),
	(31, 'Z', 'Special Offer Car', 'B'),
	(32, 'E', 'Coupe', 'B'),
	(33, 'M', 'Monospace', 'B'),
	(34, 'R', 'Recreational', 'B'),
	(35, 'H', 'Motor Home', 'B'),
	(36, 'Y', '2 Wheel Vehicle', 'B'),
	(37, 'N', 'Roadster', 'B'),
	(38, 'G', 'Crossover', 'B'),
	(39, 'K', 'Commercial Van / Truck', 'B'),
	(40, 'M', 'Manual drive', 'C'),
	(41, 'N', 'Manual, 4WD', 'C'),
	(42, 'C', 'Manual, AWD', 'C'),
	(43, 'A', 'Auto drive', 'C'),
	(44, 'B', 'Auto, 4WD', 'C'),
	(45, 'D', 'Auto, AWD', 'C'),
	(46, 'N', 'Unspecified fuel, no A/C', 'D'),
	(47, 'R', 'Unspecified fuel, A/C', 'D'),
	(48, 'D', 'Diesel, A/C', 'D'),
	(49, 'Q', 'Diesel, no A/C', 'D'),
	(50, 'H', 'Hybrid, A/C', 'D'),
	(51, 'I', 'Hybrid, no A/C', 'D'),
	(52, 'E', 'Electric, A/C', 'D'),
	(53, 'C', 'Electric, no A/C', 'D'),
	(54, 'L', 'LPG/Gas, A/C', 'D'),
	(55, 'S', 'LPG/Gas, no A/C', 'D'),
	(56, 'A', 'Hydrogen, A/C', 'D'),
	(57, 'B', 'Hydrogen, no A/C', 'D'),
	(58, 'M', 'Multi fuel, A/C', 'D'),
	(59, 'F', 'Multi fuel, no A/C', 'D'),
	(60, 'V', 'Petrol, A/C', 'D'),
	(61, 'Z', 'Petrol, no A/C', 'D'),
	(62, 'X', 'Ethanol, no A/C', 'D');
/*!40000 ALTER TABLE `sipp_codes` ENABLE KEYS */;

-- Dumping data for table ebdb.teston: ~0 rows (approximately)
/*!40000 ALTER TABLE `teston` DISABLE KEYS */;
/*!40000 ALTER TABLE `teston` ENABLE KEYS */;

-- Dumping data for table ebdb.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `title`, `name`, `username`, `email`, `password`, `phone`, `status`, `driver_licence`, `passport_id`, `rental_form`, `company_name`, `address`, `state`, `city`, `zip`, `country_id`, `other_info`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Mr', 'Muhammad Idrees', 'admin', 'medriis@gmail.com', '$2y$10$jug6WcAFvJXXKYSSJ4ixO.NwkNSwEOLouN5DmHm59Yu/ASqxCZkvO', '01193764859', 1, '', 'a12934', '', '', 'Cantt', 'Punjab', 'Lahore', '54400', 177, '', 'Tm6MlkwookfeutRf6wepclKYd6nOUnP4mtuTZbVCTE5WhL1cwxzBVdZI4Z43', NULL, '2017-07-30 05:53:16'),
	(2, 'Mr', 'Suzanne', 'suzanne', 'suzanne@embassyalliance.com', '$2y$10$rZg9troL2DAvFl8bMs4lH.LyjVeA4sb1xZXhvz3nAxDX.ttUpKhKO', '0060123208132', 1, NULL, NULL, NULL, '', '', '', '', '', 0, '', NULL, '2017-07-25 12:26:53', '2017-07-25 12:26:53'),
	(3, 'Mr', 'Imran', 'info', 'info@embassyalliance.com', '$2y$10$bSHd7mkMd2kv/y3eZPSz6.q/AlaVsf4eRDKmY5WU2wpNLW80X.Gre', '13262326232', 1, 'public/users/sQGc2diqMz5WLyabh2N4YA5VA4KbAZyOja3SVhSS.jpeg', 'public/users/R35Ol5dPKGid4Ds7utzfnQaT0mlpE6aQKc3CUxuZ.jpeg', 'public/users/DP9hsiuI5JbLESfLdJhp1U3ggFHs9WY2BTMnsPg8.jpeg', 'embassy alliance', 'kolla lumpur', 'kolla lumpur', 'kolla lumpur', '151515', 157, '', NULL, '2017-07-31 22:34:01', '2017-07-31 22:34:01'),
	(5, 'Mr', 'Vladimir Mitrofanov', 'vladimir', 'shirker2006@gmail.com', '$2y$10$2I71il5mi.WYoyVeQ8gbkOhff0DOyNVXdPkeIbMTPYUVJRvJsQ7DO', '+639296741244', 1, NULL, NULL, NULL, '', '', '', '', '', 0, '', NULL, '2017-08-04 14:22:19', '2017-08-04 14:22:19'),
	(6, 'Mr', 'Sue Y', 'michael', 'michael@embassyalliance.com', '$2y$10$ODW.7lrBL9qxjW0bySHdkuX.U1SQJ.1i6d8fCVCHU1kdu82OlpZXy', '123208132', 1, '', '123456787989', '', '', '35, Great Condo', 'Wilayah Persekutuan', 'Kuala Lumpur', '57000', 157, '', NULL, '2017-08-05 03:42:13', '2017-08-05 03:42:13'),
	(7, 'Mr', 'Imran', 'imran.z', 'imran.z@live.com', '$2y$10$d0zr4E7qnkjkbc68I75wOeXTClWkJDKvhPeNyZna16Hw305tpfLgG', '03214398400', 1, 'public/users/tBMJnNETipDsNzg8fOS9IUUqYrv7mhqsa5xKRR3r.jpeg', 'public/users/rJLBgdX7LB4oEqMhdOGHFMFq1Ebd3cVhEQtXxqGR.jpeg', 'public/users/M1uv2nuaFtJVF9L7uLELGSRmPDa9UpHx5VJl5e4u.jpeg', 'SD Solutions', '26-R1 Johar Town', 'Punjab', 'Lahore', '54000', 177, '', NULL, '2017-08-10 16:07:54', '2017-08-10 16:07:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
