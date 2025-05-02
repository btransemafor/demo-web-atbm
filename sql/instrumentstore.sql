
CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userId`, `productId`, `qty`, `productName`, `productPrice`, `productImage`) VALUES
(40, 1, 6, 1, 'Essex EUP-123EA1', '230000000', '4c301f519e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(2, 'Piano', 1),
(4, 'Guitar', 1),
(5, 'Organ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `receivedDate` date DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `createdDate`, `receivedDate`, `status`) VALUES
(39, 31, '2021-12-07', '2021-12-07', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `productPrice` decimal(10,0) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `productId`, `qty`, `productPrice`, `productName`, `productImage`) VALUES
(36, 39, 7, 2, '3190000', 'GUITAR YAMAHA CX40', 'd3ac08c33e.jpg'),
(37, 39, 4, 1, '749000000', 'Boston GP-156', 'a30bcd79d7.jpg'),
(38, 39, 8, 3, '19000000', 'Taylor 114E', 'cb50eef0d8.jpg'),
(39, 39, 9, 4, '4200000', 'Takamine D2D', '758ded2800.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `originalPrice` decimal(10,0) NOT NULL,
  `promotionPrice` decimal(10,0) NOT NULL,
  `image` varchar(50) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `cateId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `soldCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--
INSERT INTO `products` (`id`, `name`, `originalPrice`, `promotionPrice`, `image`, `createdBy`, `createdDate`, `cateId`, `qty`, `des`, `status`, `soldCount`) VALUES
(2, 'Kohler & Campbell KIG50D', '233000000', '220000000', '95548b09b3.jpg', 1, '2023-01-02', 2, 96, 'Với kích thước linh hoạt...', 1, 0),
(3, 'Kawai ND-21', '90500000', '85000000', '8d2e8819d7.jpg', 1, '2023-01-03', 2, 9, 'Đàn Piano Kawai ND-21...', 1, 0),
(4, 'Boston GP-156', '749000000', '749000000', 'a30bcd79d7.jpg', 1, '2023-01-04', 2, 19, 'Đàn piano Boston...', 1, 0),
(5, 'Kohler & Campbell J310B', '98000000', '90000000', '109cc07e03.jpg', 1, '2023-01-05', 2, 8, 'Công ty Kohler & Campbell...', 1, 0),
(6, 'Essex EUP-123EA1', '230000000', '230000000', '4c301f519e.jpg', 1, '2023-01-06', 2, 7, 'Piano Essex nổi bật...', 1, 0),
(7, 'GUITAR YAMAHA CX40', '3190000', '3190000', 'd3ac08c33e.jpg', 1, '2023-01-07', 4, 8, 'Đàn Classic Guitar Yamaha CX40', 1, 0),
(8, 'Taylor 114E', '19000000', '19000000', 'cb50eef0d8.jpg', 1, '2023-01-08', 4, 7, 'Đàn guitar Taylor 114E...', 1, 0),
(9, 'Takamine D2D', '4200000', '4200000', '758ded2800.jpg', 1, '2023-01-09', 4, 6, 'Đàn guitar Takamine D2D...', 1, 0),
(10, 'Takamine ED2DCNAT', '6350000', '6200000', '1dfd0eec5c.jpg', 1, '2023-01-10', 4, 10, 'Takamine ED2DCNAT thiết kế hoàn hảo...', 1, 0),
(11, 'TAYLOR 150E 12 String', '21100000', '21100000', '9bc38b3364.jpg', 1, '2023-01-11', 4, 10, 'TAYLOR 150E với 12 dây...', 1, 0),
(12, 'TAYLOR 214CE DLX', '34700000', '34700000', 'e235fe0bc6.jpg', 1, '2023-01-12', 4, 10, 'Taylor 214CE DLX trung thực...', 1, 0),
(13, 'Roland BK-9', '31000000', '31000000', 'bf843e62a9.jpg', 1, '2023-01-13', 5, 20, 'Organ Roland BK-9 cao cấp...', 1, 0),
(14, 'Roland E-A7', '29000000', '29000000', 'd1a3f61f87.jpg', 1, '2023-01-14', 5, 15, 'Organ Roland E-A7 cho biểu diễn...', 1, 0),
(15, 'Roland FA-06', '29500000', '29500000', '8f40bd6405.jpg', 1, '2023-01-15', 5, 10, 'FA-06 nhỏ gọn, mạnh mẽ', 1, 0),
(16, 'Roland FA-08', '44300000', '44300000', 'a12f8914dc.jpg', 1, '2023-01-16', 5, 10, 'FA-08 workstation chuyên nghiệp', 1, 0),
(17, 'Roland AXSYNTH', '25100000', '25100000', '422b3a5da2.jpg', 1, '2023-01-17', 5, 20, 'AXSYNTH phong cách solo đeo vai', 1, 0),
(18, 'Roland GAIA SH-01', '14300000', '14300000', 'c43d221a7b.jpg', 1, '2023-01-18', 5, 5, 'GAIA SH-01 hiệu ứng tuyệt vời', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(500) NOT NULL,
  `isConfirmed` tinyint(4) NOT NULL DEFAULT 0,
  `captcha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `dob`, `password`, `role_id`, `status`, `address`, `isConfirmed`, `captcha`) VALUES
(1, 'admin@gmail.com', 'Nguyễn Lập An Khương', '2021-11-01', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '', 1, ''),
(31, 'lapankhuongnguyen@gmail.com', 'khuong nguyen', '2021-12-06', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 'CanTho', 1, '56661');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `product_id` (`productId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`orderId`),
  ADD KEY `product_id` (`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cateId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cateId`) REFERENCES `categories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
