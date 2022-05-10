-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2022 at 07:44 AM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studhchk_studydigs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `first_name`, `password`, `creation_date`) VALUES
(1, 'kjs15', 'Kia', '$2a$10$C84MDZj2K6PUpZiIBNWreehEoA96eMLLPvDV5bxeh5j51v/zcLXDu', '2022-04-12 20:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `postcode` varchar(11) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo_file_location` text DEFAULT NULL,
  `fees_paid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `image_type`
--

CREATE TABLE `image_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_type`
--

INSERT INTO `image_type` (`id`, `type`) VALUES
(1, 'feature'),
(2, 'house'),
(3, 'floorplan');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_date` datetime NOT NULL DEFAULT current_timestamp(),
  `opened` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `sent_date`, `opened`) VALUES
(4, 'Kia', 'kiasambrook@btinternet.com', 'Missing universities', 'Hi, I noticed there are a few universities missing from the list, such as Swansea. I was just wondering if you can add them to the site please?', '2022-03-28 12:58:27', 1),
(5, 'Johnny', 'john@blogs.com', 'Property Upload Error', 'Hey, I just tried to upload a new property to my portfolio but the images failed to upload. They are not appearing in the slideshow but the property uploads without any error messages.\r\nPlease could you get back to me, thanks!\r\nCompany: Cutting Fresh', '2022-04-13 19:09:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `flat_number` varchar(255) NOT NULL,
  `building_number` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `town` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `property_type` int(11) NOT NULL,
  `on_market` tinyint(1) NOT NULL DEFAULT 1,
  `availability_date` date NOT NULL DEFAULT current_timestamp(),
  `min_contract_length` int(11) DEFAULT NULL COMMENT 'Store these as a months then convert back to years ',
  `max_contract_length` int(11) DEFAULT NULL COMMENT 'Store these as a months then convert back to years ',
  `deposit` int(11) NOT NULL,
  `monthly_cost` int(11) NOT NULL,
  `tenancy_info` text NOT NULL DEFAULT 'No information provided.',
  `upload_date` datetime NOT NULL DEFAULT current_timestamp(),
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property_amenities`
--

CREATE TABLE `property_amenities` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL DEFAULT 0,
  `bathrooms` int(11) NOT NULL DEFAULT 0,
  `ensuite` int(11) DEFAULT 0,
  `double_bed` int(11) NOT NULL DEFAULT 0,
  `parking_space` int(11) NOT NULL DEFAULT 0,
  `garden` tinyint(1) NOT NULL DEFAULT 0,
  `washing_machine` tinyint(1) NOT NULL DEFAULT 0,
  `wifi` tinyint(1) NOT NULL DEFAULT 0,
  `pets` tinyint(1) NOT NULL DEFAULT 0,
  `dual_occupancy` tinyint(1) NOT NULL DEFAULT 0,
  `lockable_bedrooms` tinyint(1) NOT NULL DEFAULT 0,
  `bills_included` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `file_location` text NOT NULL,
  `image_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `type`) VALUES
(1, 'flat'),
(2, 'maisonette'),
(3, 'studio'),
(4, 'terraced'),
(5, 'semi-detached '),
(6, 'detached'),
(7, 'townhouse');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `address1`, `address2`, `town`, `postcode`, `longitude`, `latitude`) VALUES
(1, 'University of Aberdeen', 'Elphinstone Road', 'King\'s College', 'Aberdeen', 'AB243FX', '-2.100236', '57.164841'),
(2, 'Abertay University', 'Bell Street', '', 'Dundee', 'DD11HG', '-2.974299', '56.463117'),
(3, 'Aberystwyth Unviersity', 'Penglais', '', 'Aberystwyth', 'SY23 3FL', '-4.06526', '52.41777'),
(6, 'University of Dundee', '2 Airlie Place', '', 'Dundee', 'DD14HN', '-2.978269', '56.457345'),
(7, 'Bath Spa University', 'Newton Park', 'Newton St Loe', 'Bath', 'BA29BN', '-2.440912', '51.373209'),
(10, 'University of Bath', 'Claverton Down', '', 'Bath', 'BA27AY', '-2.326913', '51.378236'),
(11, 'University of Bristol', 'Beacon House', 'Queens Road', 'Bristol', 'BS81QU', '-2.607297', '51.457119'),
(12, 'Cranfield University', 'College Road', '', 'Cranfield', 'MK430AL', '-0.630801', '52.069817'),
(13, 'University of Bedfordshire', 'University Square', '', 'Luton', 'LU13JU', '-0.411539', '51.87825'),
(14, 'University of Buckingham', 'Yeomanry House', 'Hunter Street', 'Buckingham', 'MK181EG', '-0.991839', '51.995998'),
(15, 'Buckinghamshire New University', 'Queen Alexandra Road', '', 'High Wycombe', 'HP112JZ', '-0.752036', '51.627509'),
(16, 'Anglia Ruskin University', 'East Road', '', 'Cambridge', 'CB11PT', '0.13461', '52.203402'),
(17, 'University of Cambridge', 'The Old Schools', 'Trinity Lane', 'Cambridge', 'CB2 1TN', '0.116179', '52.205105'),
(18, 'University of Chester', 'Parkgate Road', '', 'Chester', 'CH14BJ', '-2.898165', '53.198604'),
(19, 'Teesside University', 'Borough Road', 'Tees Valley', 'Middlesbrough', 'TS13BA', '-1.234694', '54.572076'),
(20, 'Falmouth University', 'Woodlane', '', 'Falmouth', 'TR114RH', '-5.071079', '50.149625'),
(21, 'Queen\'s University Belfast', 'University Road', '', 'Belfast', 'BT71NN', '-5.934438', '54.584772'),
(22, 'Durham University', 'The Palatine Centre', 'Stockton Road', 'Durham', 'DH13LE', '-1.571874', '54.768112'),
(23, 'Ulster University', 'Cromore Road', '', 'Coleraine', 'BT521SA', '-6.676089', '55.149335'),
(24, 'University of Cumbria', 'Fusehill Street', '', 'Carlislse', 'CA12HH', '-2.921417', '54.891163'),
(25, 'University of Derby', 'Kedleston Road', '', 'Derby', 'DE221GB', '-1.496678', '52.938473'),
(26, 'University of Exeter', 'Northcote House', 'The Queen\'s Drive', 'Exeter', 'EX44QJ', '-3.535048', '50.735156'),
(27, 'Plymouth College of Art', 'Tavistock Place', '', 'Plymout', 'PL48AT', '-4.137411', '50.37341'),
(28, 'Arts University Bournemouth', 'Wallisdown', '', 'Poole', 'BH125HH', '-1.897728', '50.741808'),
(29, 'Bournemouth University', 'Fern Barrow', '', 'Poole', 'BH125BB', '-1.897168', '50.742979'),
(30, 'University of Brighton', 'Mithras House', 'Lewes Road', 'Brighton', 'BN24AT', '-0.11917', '50.842454'),
(31, 'University of Essex', 'Wivenhoe Park', 'Colchester', 'Essex', 'CO4 3SQ', '0.946585', '51.87681'),
(32, 'Royal Agricultural University', 'Stroud Road', '', 'Colchester', 'GL76JS', '-1.994916', '51.709508'),
(33, 'University of Gloucestershire', 'The Park', '', 'Cheltenham', 'GL502RH', '-2.087706', '51.887603'),
(34, 'Bangor University', 'College Road', '', 'Bangor', 'LL572DG', '-4.129437', '53.229193'),
(35, 'Solent University', 'Eas Park Terrace', '', 'Southampton', 'SO140YN', '-1.401021', '50.90759'),
(36, 'University of Winchester', 'Spakrford Road', '', 'Winchester', 'SO224NR', '-1.32674', '51.060002'),
(37, 'University of Hertfordshire', 'College Lane', 'Hatfield', 'Hertfordshire', 'AL109AB', '-0.242179', '51.752882'),
(38, 'Canterbury Christ Church University', 'North Holmes Road', '', 'Canterbury', 'CT11QU', '1.089364', '51.279643'),
(39, 'University for the Creative Arts', 'New Dover Road', '', 'Canterbury', 'CT13AN', '1.09084', '51.274926'),
(40, 'University of Kent', 'University of Kent', 'The Registry Canterbury', 'Canterbury', 'CT27NZ', '1.070975', '51.298503'),
(41, 'University of Glasgow', 'University Avenue', '', 'Glasgow', 'G128QQ', '-4.28836', '55.871751'),
(42, 'University of Bolton', 'Deane Road', '', 'Bolton', 'BL35AB', '-2.436238', '53.573511'),
(43, 'Lancaster University', 'Bailrigg', '', 'Lancaster', 'LA14YW', '-2.786451', '54.010418'),
(44, 'Manchester Metropolitan University', 'All Saints Building', 'All Saints', 'Manchester', 'M156BH', '-2.239115', '53.470917'),
(45, 'The University of Manchester', 'Oxford Road', '', 'Manchester', 'M139PL', '-2.233578', '53.466926'),
(46, 'Edge Hill University', 'St Helens Road', '', 'Ormskirk', 'L394QP', '-2.873836', '53.559608'),
(47, 'University of Central Lancashire', 'Foster Building', '', 'Preston', 'PR12HE', '-2.707384', '53.761338'),
(48, 'De Montfort University', 'Trinity House', 'The Gateway', 'Leicester', 'LE19BH', '-1.137676', '52.629312'),
(49, 'University of Leicester', 'University Road', '', 'Leicester', 'LE17RH', '-1.125526', '52.620665'),
(50, 'Loughborough University', 'Epinal Way', '', 'Loughborough', 'LE113TU', '-1.22952', '52.764828'),
(51, 'University of Lincoln', 'Brayford Pool', '', 'Lincoln', 'LN67TS', '-0.547796', '53.228487'),
(52, 'Middlesex University', 'Hendon Campus', 'The Burroughs', 'London', 'NW44BT', '-0.228945', '51.589833'),
(53, 'London South Bank University', '103 Borough Road', '', 'London', 'SE10AA', '-0.101772', '51.498708'),
(54, 'Birkbeck, University of London', 'Malet Street', 'Bloomsbury', 'London', 'WC1E7HX', '-0.130359', '51.521891'),
(55, 'London Business School', 'Regent\'s Park', '', 'London', 'NW14SA', '-0.161378', '51.526581'),
(56, 'London School of Hygiene and Tropical Medicine, University of London', 'Keppel Street', '', 'London', 'WC1E7HT', '-0.130687', '51.520925'),
(57, 'Regent\'s University London', 'Regent\'s Park', '', 'London', 'NW14NS', '-0.15566', '51.525745'),
(58, 'Royal Academy of Music, University of London', 'Marylebone Road', '', 'London', 'NW15HT', '-0.1517', '51.523497'),
(59, 'Royal Veterinary College University of London', 'Royal College Street', '', 'London', 'NW10TU', '-0.133524', '51.536851'),
(60, 'University College London', 'Gower Street', '', 'London', 'WC1E6BT', '-0.132424', '51.523569'),
(61, 'University of East London', 'Docklands Campus', '4-6 University Way', 'London', 'E162RD', '0.063234', '51.507567'),
(62, 'University of Greenwich', '30 Park Row', 'Greenwich', 'London', 'SE109LS', '-0.004005', '51.484468'),
(66, 'City, University Of London', 'Northampton Square', '', 'London', 'EC1V0HB', '-0.103099', '51.527903'),
(67, 'London Metropolitan University', '166-220 Holloway Road', '', 'London', 'N7 8DB', '-0.110381', '51.551471'),
(68, 'Imperial College London', 'South Kensington Campus', '', 'London', 'SW7 2AZ', '-0.176923', '51.498317'),
(69, 'Goldsmiths, University Of London', 'New Cross', '', 'London', 'SE14 6NW', '-0.035401', '51.474144'),
(70, 'Queen Mary University Of London', 'Mile End Road', '', 'London', 'E1 4NS', '-0.04071', '51.524636'),
(71, 'King&#39;s College London', 'Strand', '', 'London', 'WC2R 2LS', '-0.116253', '51.511612'),
(72, 'Liverpool Hope University', 'Hope Park', '', 'Liverpool', 'L16 9JD', '-2.891907', '53.391527'),
(73, 'Liverpool John Moores University', '70 Mount Pleasant', '', 'Liverpool', 'L3 5UX', '-2.973176', '53.403685'),
(74, 'St Mary&#39;s University, Twickenham', 'Waldegrave Road', 'Strawberry Hill', 'Twickenham', 'TW1 4SX', '-0.335907', '51.436152'),
(75, 'Brunel University London', 'Kingston Lane', '', 'Uxbridge', 'UB8 3PH', '-0.472856', '51.532838'),
(76, 'Edinburgh Napier University', 'Sighthill Campus', 'Sighthill Court', 'Edinburgh', 'EH11 4BN', '-3.288471', '55.924076'),
(77, 'Heriot-Watt University', 'Edinburgh Campus', 'Riccarton', 'Edinburgh', 'EH14 4AS', '-3.320682', '55.909385'),
(78, 'The University Of Edinburgh', 'Old College', 'South Bridge', 'Edinburgh', 'EH8 9YL', '-3.187347', '55.947691'),
(79, 'Queen Margaret University', 'Queen Margaret University Way', 'Musselburgh', 'Edinburgh', 'EH21 6UU', '-3.073057', '55.931281'),
(80, 'Norwich University Of The Arts', 'Francis House', '3-7 Redwell Street', 'Norwich', 'NR2 4SN', '1.297272', '52.630494'),
(81, 'University Of East Anglia', 'Norwich Research Park', '', 'Norwich', 'NR4 7TJ', '1.241391', '52.622369'),
(82, 'The University Of Hull', 'Cottingham Road', '', 'Hull', 'HU6 7RX', '-0.366384', '53.771778'),
(83, 'The University Of York', 'Heslington', '', 'York', 'YO10 5DD', '-1.053544', '53.948419'),
(84, 'The University Of Northampton', 'Boughton Green Road', '', 'Northampton', 'NN1 5PH', '-0.890179', '52.231606'),
(85, 'Nottingham Trent University', '50 Shakespeare Street', '', 'Nottingham', 'NG1 4FQ', '-1.150917', '52.957778'),
(86, 'The University Of Nottingham', 'University Park', '', 'Nottingham', 'NG7 2RD', '-1.191193', '52.940521'),
(87, 'Oxford Brookes University', 'Gipsy Lane', 'Headington', 'Oxford', 'OX3 0BP', '-1.2232', '51.75438'),
(88, 'Harper Adams University', 'Edgmond', '', 'Newport', 'TF10 8NB', '-2.425557', '52.77991'),
(89, 'Cardiff Metropolitan University', '200 Western Avenue', '', 'Cardiff', 'CF5 2YB', '-3.21211', '51.495831'),
(90, 'Cardiff University', 'Newport Road', '', 'Cardiff', 'CF24 0DE', '-3.166189', '51.484131'),
(91, 'Sheffield Hallam University', 'Howard Street', '', 'Sheffield', 'S1 1WB', '-1.465255', '53.379194'),
(92, 'The University Of Sheffield', 'Western Bank', '', 'Sheffield', 'S10 2TN', '-1.48853', '53.381363'),
(93, 'Keele University', 'Keele Hall', '', 'Keele', 'ST5 5BG', '-2.273581', '53.003262'),
(94, 'Staffordshire University', 'College Road', 'University Quarter', 'Stoke-on-Trent', 'ST4 2DE', '-2.180352', '53.009202'),
(95, 'Royal Holloway, University Of London', 'Egham Hill', '', 'Egham', 'TW20 0EX', '-0.566745', '51.424814'),
(96, 'University Of Surrey', 'Stag Hill', 'Guildford', 'Surrey', 'GU2 7XH', '-0.587936', '51.242685'),
(97, 'Kingston University', 'River House', '53-57 High Street', 'Kingston upon Thames', 'KT1 1LQ', '-0.30786', '51.406309'),
(98, 'Newcastle University', 'King&#39;s Gate', '', 'Newcastle upon Tyne', 'NE1 7RU', '-1.615713', '54.98032'),
(99, 'Northumbria University', 'City Campus', '2 Ellison Place', 'Newcastle upon Tyne', 'NE1 8ST', '-1.60745', '54.976634'),
(100, 'Swansea University', 'Singleton Park', '', 'Swansea', 'SA2 8PP', '-3.980616', '51.609627'),
(101, 'Aston University', 'Aston Triangle', '', 'Birmingham', 'B4 7ET', '-1.890952', '52.486637'),
(102, 'Birmingham City University', 'University House', '15 Bartholomew Row', 'Birmingham', 'B5 5JU', '-1.888824', '52.481921'),
(103, 'University Of Birmingham', 'Edgbaston', '', 'Birmingham', 'B15 2TT', '-1.92789', '52.453282'),
(104, 'Coventry University', 'Priory Street', '', 'Coventry', 'CV1 5FB', '-1.500063', '52.405314'),
(105, 'The University Of Warwick', 'University House', 'Gibbet Hill', 'Coventry', 'CV4 7AL', '-1.564814', '52.38581'),
(106, 'University Of Bradford', 'Richmond Road', '', 'Bradford', 'BD7 1DP', '-1.763774', '53.791584'),
(107, 'University Of Huddersfield', 'Queensgate', '', 'Huddersfield', 'HD1 3DH', '-1.778726', '53.643678'),
(108, 'Leeds Arts University', 'Blenheim Walk', '', 'Leeds', 'LS2 9AQ', '-1.551775', '53.808429'),
(109, 'Leeds Beckett University', 'Calverley Street', '', 'Leeds', 'LS1 3HE', '-1.548578', '53.80402'),
(110, 'Leeds Trinity University', 'Brownberrie Lane', 'Horsforth', 'Leeds', 'LS18 5HD', '-1.64735', '53.84878'),
(111, 'University Of Leeds', 'Woodhouse Lane', '', 'Leeds', 'LS2 9JT', '-1.553329', '53.807958');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `vkey` text NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_type`
--
ALTER TABLE `image_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `property_type` (`property_type`);

--
-- Indexes for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `image_type` (`image_type`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `image_type`
--
ALTER TABLE `image_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `property_amenities`
--
ALTER TABLE `property_amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `company_id_to_property` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `property_type_id_to_property` FOREIGN KEY (`property_type`) REFERENCES `property_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD CONSTRAINT `property_amenities_id` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `image_type_id` FOREIGN KEY (`image_type`) REFERENCES `image_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `property_img_id` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
