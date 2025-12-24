-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2025 at 08:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_order`
--

CREATE TABLE `cancel_order` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `product_name` varchar(15) NOT NULL,
  `total_price` int(10) NOT NULL,
  `placed_on` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancel_order`
--

INSERT INTO `cancel_order` (`id`, `user_id`, `name`, `number`, `email`, `address`, `product_name`, `total_price`, `placed_on`) VALUES
(1, 3, 'Krushnraj', '7041565859', 'zkrushnraj@gmail.com', 'Flat No. 4, amidhare, bhavnagar, india - 364002', 'Raat Ran', 828, '23-Mar-2025'),
(2, 3, 'Bhumi', '8849428124', 'ayushiba@gmail.com', 'flat no. 5, amithara, bhavnagar, india - 364001', 'Cow Manu', 120, '23-Mar-2025'),
(3, 3, 'Krushnraj', '7041565859', 'zkrushnraj@gmail.com', 'Flat No. 4, amidhare, bhavnagar, india - 364002', 'Raat Ran', 828, '23-Mar-2025'),
(4, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Raat Rani Plant', 348, '28-Mar-2025'),
(5, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Transplanting T', 132, '28-Mar-2025'),
(6, 3, 'Krushnraj', '7041565859', 'zkrushnraj@gmail.com', 'Flat No. 4, amidhare, bhavnagar, india - 364002', 'Raat Ran', 828, '23-Mar-2025'),
(7, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Raat Rani Plant', 348, '28-Mar-2025'),
(8, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Transplanting T', 264, '28-Mar-2025'),
(9, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Raat Rani Plant', 348, '28-Mar-2025'),
(10, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Vermicompost (1', 250, '28-Mar-2025'),
(11, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Button Rose Pla', 299, '28-Mar-2025'),
(12, 3, 'Ayushiba', '1234567897', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Capsicum Green ', 59, '28-Mar-2025'),
(13, 3, 'Ayushiba', '1234567897', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Bone Meal Powde', 249, '28-Mar-2025');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) NOT NULL,
  `image_name` varchar(20) NOT NULL,
  `image` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_name`, `image`) VALUES
(1, 'Oak Tree', 'oak.jpg'),
(2, 'Palm tree', 'palm.jpg'),
(3, 'Pine tree', 'pine.jpg'),
(4, 'Cherry Blossom', 'cherry.jpg'),
(5, 'Sheesham Tree', 'sheesham.jpg'),
(6, 'Maple Tree', 'maple.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `green_hero`
--

CREATE TABLE `green_hero` (
  `id` int(10) NOT NULL,
  `hero_name` varchar(25) NOT NULL,
  `description` varchar(500) NOT NULL,
  `hero_image` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `green_hero`
--

INSERT INTO `green_hero` (`id`, `hero_name`, `description`, `hero_image`) VALUES
(1, 'Saalumarada Thimmakka', 'Saalumarada Thimmakka, an environmentalist from Karnataka, is known for planting over 8,000 trees, including 384 banyan trees along a highway. Born in poverty with no formal education, she dedicated her life to afforestation. Honored with the Padma Shri Award in 2019, she continues to inspire environmental conservation efforts. Her legacy proves one person can make a lasting impact on nature.', 'Saalumarada.jpg'),
(2, 'Deepak Gaur', '        Deepak Gaur, known as Gurgaon\'s Tree Man, is an environmentalist dedicated to afforestation. After surviving a near-fatal accident in 2010, he pledged to plant and gift trees, promoting green initiatives like \"Gift a Tree\" and \"Maitri Viriksha.\" He has planted thousands of saplings, aiming for a billion trees. For his efforts in combating pollution, he has received multiple environmental awards and recognition.', 'Deepak_Gaur.jpg'),
(3, 'Jadav Payeng', 'Jadav Payeng, known as the Forest Man of India, is an environmentalist from Assam who transformed a barren sandbar into a 1,360-acre forest over four decades. Since 1979, he has planted thousands of trees, creating the Molai Forest, which now shelters elephants, tigers, and diverse wildlife. His dedication to afforestation has earned him Padma Shri in 2015 and global recognition.', 'Jaydev_Payeng.png'),
(4, 'Yoganathan', '        Yoganathan, a Tamil Nadu-based eco-warrior, has single-handedly planted over 1 lakh trees across 32 districts in the past three decades. A bus conductor by profession, he spends his free time educating students about environmental conservation. His dedication to afforestation and spreading awareness has earned him multiple awards, making him an inspiration for sustainable living.', 'Yoganathan - Copy.png'),
(5, ' Shyam Kumar', '        Shyam Kumar, an auto driver and passionate reader, discovered the 2,000-year-old book Vrikshayurveda, an ancient Indian text on plant science. Inspired by its wisdom, he began applying traditional techniques to grow trees and promote afforestation. His dedication to sustainable living has led him to plant thousands of trees, reviving lost ecological knowledge and inspiring many.', 'Shyam.png'),
(6, 'Alok Shukla', '        Alok Shukla, an environmental activist from India, led a movement to protect 445,000 acres of biodiverse forests in Chhattisgarh from 21 proposed coal mines. As the convener of the Chhattisgarh Bachao Andolan, he mobilized local communities, advocating for forest rights and sustainable development. His efforts halted mining projects, preserving wildlife, indigenous lands, and ecosystems, earning him the 2024 Goldman Environmental Prize.', 'Alok.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 3, 'Krushnraj', 'zkrushnraj@gmail.com', '7041565859', 'Your Website Is Very Good For Beginner and This We'),
(4, 3, 'Ayushiba', 'zalashivbhadrasinh1@gmail.com', '1234567895', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `product_name` varchar(15) NOT NULL,
  `total_price` int(10) NOT NULL,
  `placed_on` varchar(15) NOT NULL,
  `total_product` int(5) NOT NULL,
  `payment_status` varchar(10) NOT NULL,
  `method` varchar(10) NOT NULL,
  `order_status` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `product_name`, `total_price`, `placed_on`, `total_product`, `payment_status`, `method`, `order_status`) VALUES
(8, 3, 'Ayushiba', '1234567895', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Button Rose Pla', 299, '28-Mar-2025', 1, 'Pending', 'Credit Car', 'update_order'),
(9, 3, 'Ayushiba', '1234567897', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Capsicum Green ', 59, '28-Mar-2025', 1, 'Pending', 'COD', 'Pending'),
(10, 3, 'Ayushiba', '1234567897', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Bone Meal Powde', 249, '28-Mar-2025', 1, 'Complete', 'Credit Car', 'Pending'),
(11, 3, 'Ayushiba', '1234567897', 'zalashivbhadrasinh1@gmail.com', 'Flat No. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Transplanting T', 132, '28-Mar-2025', 1, 'Complete', 'Credit Car', 'Pending'),
(12, 3, 'Ayushiba', '1234567897', 'zalashivbhadrasinh1@gmail.com', 'flat no. 5, cvbxcbcx, BHAVANAGER, India - 364002', 'Raat Rani Plant', 348, '28-Mar-2025', 1, 'Complete', 'Credit Car', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `plant_type`
--

CREATE TABLE `plant_type` (
  `id` int(10) NOT NULL,
  `plant_type` varchar(25) NOT NULL,
  `location` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant_type`
--

INSERT INTO `plant_type` (`id`, `plant_type`, `location`, `description`, `image`) VALUES
(1, 'Succulent plant', 'Deserts, dry regions, Africa, Mexico, Austral', '        Succulents are drought-resistant plants that store water in their leaves, stems, or roots. They come in various shapes, including rosettes (Echeveria), spiky (Aloe Vera), trailing (String of Pearls), and columnar (Cacti). Native to dry regions, they require minimal water and thrive in bright light. Popular for home decor, succulents are easy to maintain and purify the air.', 'Succulent1.jpg'),
(2, 'fern', 'Rainforests, temperate forests, South America', '        Ferns are ancient, non-flowering plants with feathery, divided leaves called fronds. They reproduce via spores instead of seeds and thrive in moist, shaded environments. Found in forests, gardens, and indoors, ferns help purify air and add lush greenery. Popular types include Boston Fern, Maidenhair Fern, and Tree Fern. They require high humidity, indirect light, and well-drained soil to grow well.', 'Fern1.jpg'),
(3, 'Cactus', 'Deserts, arid regions, North and South Americ', '        Cactus plants are drought-resistant succulents known for their thick, fleshy stems that store water. They thrive in arid regions and have spines instead of leaves to reduce water loss. Common types include Saguaro, Prickly Pear, and Barrel Cactus. They require bright sunlight, minimal watering, and well-draining soil. Cacti are popular for home decor and landscaping due to their unique shapes and low maintenance.', 'Cactus1.jpg'),
(4, 'Aquatic Plant', 'Ponds, lakes, rivers, wetlands, Asia', '        Aquatic plants, or hydrophytes, grow in water bodies like lakes, ponds, and rivers. They are classified as submerged (e.g., Eelgrass), floating (e.g., Water Hyacinth), and emergent (e.g., Lotus). These plants oxygenate water, provide habitat, prevent erosion, and absorb excess nutrients, improving water quality. However, pollution and invasive species threaten their balance, requiring conservation efforts.', 'Aquatic1.jpg'),
(5, 'Carnivorous Plant', 'Boggy areas, wetlands, North America', '        Carnivorous plants are specialized flora that derive nutrients by trapping and digesting insects and small animals. They thrive in nutrient-poor soils, using modified leaves as traps. Types include Venus flytrap, which snaps shut on prey; pitcher plants, which drown insects in digestive fluids; and sundews, which use sticky tentacles. They secrete enzymes to break down prey, absorbing essential nutrients like nitrogen and phosphorus.', 'Carni1.jpg'),
(6, 'Epiphyte Plant', 'Tropical rainforests, South America', '        Epiphyte plants grow on trees, rocks, or other surfaces without soil, absorbing moisture and nutrients from the air and rain. Common types include orchids, bromeliads, staghorn ferns, and mosses. Found in tropical and subtropical forests, they thrive in humid environments. Epiphytes do not harm their hosts but use them for support. They play a vital role in ecosystems by providing habitat and oxygen while aiding biodiversity.', 'Epiphyte1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `p_type` varchar(20) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(20) NOT NULL,
  `qty` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `p_type`, `price`, `image`, `qty`) VALUES
(1, 'Raat Rani Plant', 'Palnt', 348, 'p1.jpg', 95),
(2, 'Transplanting Trowel', 'Gradaning_Tools', 132, 'p2.jpg', 95),
(3, 'Capsicum Green Seeds', 'Seeds', 59, 'p3.jpg', 99),
(4, 'Vermicompost', 'Fertilizer', 250, 'p4.jpg', 99),
(5, 'Cow Manure', 'Fertilizer', 120, 'p5.jpg', 99),
(6, 'Button Rose Plant ', 'Palnt', 299, 'p6.jpg', 99),
(7, 'Pruning Shear', 'Gradaning_Tools', 199, 'p7.jpg', 100),
(8, 'Cherry Tomato Seeds', 'Seeds', 119, 'p8.jpg', 100),
(9, 'Bone Meal Powder', 'Fertilizer', 249, 'p9.jpg', 99),
(11, 'Hand Cultivator', 'Gradaning_Tools', 212, 'p12.jpg', 100),
(12, 'MiniSucculent Garden Pack', 'Palnt', 829, 'p13.jpg', 50),
(13, 'Carrot Seed', 'Seeds', 59, 'p14.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

CREATE TABLE `tips` (
  `id` int(3) NOT NULL,
  `p_name` varchar(25) NOT NULL,
  `tip` varchar(300) NOT NULL,
  `image` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `p_name`, `tip`, `image`) VALUES
(1, 'Button Rose Plant', '        Button rose plants thrive in well-draining soil with full to partial sunlight. Water regularly but avoid overwatering. Prune dead flowers to encourage blooming. Feed with balanced fertilizer every 2-3 weeks. Protect from pests like aphids for healthy growth.', 'p6.jpg'),
(2, 'Cow Manure', '        Aged or composted cow manure is best for plants. Mix it into the soil before planting or apply a 1-inch layer as mulch. Avoid using fresh manure, as it can burn roots. Water after application to help nutrients absorb. Use every 4-6 weeks for healthier growth.', 'p5.jpg'),
(3, 'Raat Rani Plant', '        Plant Raat Rani in well-draining, sandy soil and ensure it gets 4-6 hours of sunlight daily. Water moderately, keeping the soil moist but avoiding overwatering. Fertilize monthly with compost or liquid fertilizer to promote healthy growth. Prune after flowering to encourage bushy growth and ', 'p1.jpg'),
(4, 'Vermicompost', '        Apply vermicompost by mixing it into the topsoil or using it as a mulch. Use 1-2 inches around plants every 2-3 months. For potted plants, mix 20-25% vermicompost with soil. Water after application to help nutrients absorb. Avoid overuse to prevent nutrient imbalance.', 'p4.jpg'),
(5, 'Pruning Shear', '    Use pruning shears to trim dead, diseased, or overgrown branches. Hold firmly and make clean cuts at a 45° angle above a leaf node. Use on flowers, shrubs, and small branches. Clean blades after use to prevent disease spread. Regular sharpening ensures precise cuts.    ', 'p7.jpg'),
(6, 'Capsicum Green Seeds', '        Sow capsicum green seeds in well-draining soil, ¼ inch deep. Keep in warm, sunny spots (18-25°C). Water lightly to keep soil moist. Germination takes 7-14 days. Transplant seedlings after 4-6 leaves appear. Provide support as plants grow. Fertilize every 2 weeks for best yield.', 'p3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tree_type`
--

CREATE TABLE `tree_type` (
  `id` int(10) NOT NULL,
  `tree_type` varchar(25) NOT NULL,
  `location` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tree_type`
--

INSERT INTO `tree_type` (`id`, `tree_type`, `location`, `description`, `image`) VALUES
(1, 'Hardwood Tree', 'Tropical forests, Southeast Asia', '        Hardwood trees are deciduous, broad-leaved trees found in temperate and tropical regions. They belong to angiosperms and shed leaves annually. Common hardwoods include oak, maple, mahogany, and teak. These trees have dense, durable wood used for furniture, flooring, and construction. They grow slower than softwoods but offer high strength and resistance. Hardwood trees support biodiversity by providing habitat and oxygen.', 'hardwood.jpg'),
(2, 'Softwood Tree ', 'Northern Hemisphere, Canada, Russia', '        Softwood trees are coniferous, evergreen trees with needle-like leaves and seed-bearing cones. They grow faster than hardwoods, making them a primary source for timber, paper, and construction materials. Common softwoods include pine, cedar, fir, spruce, and redwood. Their wood is lighter, less dense, and easier to work with. Softwood trees play a crucial role in ecosystems, providing habitat, oxygen, and carbon absorption while thriving in colder climates.', 'softwood.jpg'),
(3, 'Coniferous Tree', 'Taiga regions, Canada, Russia', 'Coniferous trees are evergreen, needle-leaved trees that produce cones to house their seeds. They thrive in colder climates and are commonly found in boreal forests. Examples include pine, spruce, fir, cedar, and redwood. These trees grow tall and straight, providing softwood timber for construction, paper, and furniture. Conifers play a vital ecological role, offering wildlife habitats, reducing carbon dioxide, and preventing soil erosion.', 'Coniferous.jpg'),
(4, 'Fruit Tree', 'temperate regions, India, China, USA', 'A fruit tree is a tree that produces edible fruits, providing essential nutrients and flavors enjoyed worldwide. Common types include apple, pear, cherry, peach, plum, orange, lemon, mango, fig, and pomegranate trees. These trees play a crucial role in ecosystems by supporting pollinators and wildlife. Cultivated for food, shade, and beauty, fruit trees thrive in diverse climates and require proper care for optimal growth and fruit production.', 'Fruit.jpg'),
(5, 'Wetland Tree', 'Southeast Asia,USA, Amazon Basin', '        Wetland trees thrive in water-rich environments like swamps, marshes, and riverbanks, playing a crucial role in flood control and ecosystem balance. They have adapted to survive in saturated soils with features like buttress roots and aerial roots for stability and oxygen intake. Common species include bald cypress, mangroves, and willows. These trees provide habitat for wildlife and improve water quality by filtering pollutants.', 'wetland.jpg'),
(6, 'Bonsai Tree', 'Japan, China, USA, Europe', '        Bonsai trees are miniature, artistically cultivated trees grown in containers, symbolizing harmony, patience, and balance. Originating from ancient Chinese and Japanese traditions, bonsai requires careful pruning, wiring, and root trimming to maintain its shape. Popular species include juniper, ficus, and maple. These trees thrive with proper sunlight, watering, and soil care, offering a peaceful, meditative hobby for enthusiasts.', 'bonsai.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(3, 'krushnraj', 'zkrushnraj@gmail.com', '472005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cancel_order`
--
ALTER TABLE `cancel_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `foreign` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `green_hero`
--
ALTER TABLE `green_hero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plant_type`
--
ALTER TABLE `plant_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree_type`
--
ALTER TABLE `tree_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cancel_order`
--
ALTER TABLE `cancel_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `green_hero`
--
ALTER TABLE `green_hero`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `plant_type`
--
ALTER TABLE `plant_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tree_type`
--
ALTER TABLE `tree_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `foregin key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `foregin_key_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
