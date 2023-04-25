-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 06:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_learning_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`) VALUES
(1, 'Development', 'Active'),
(2, 'Business', 'Active'),
(3, 'Finance', 'Active'),
(4, 'IT Software', 'Active'),
(5, 'Office Productivity', 'Active'),
(6, 'Personal Development', 'Active'),
(7, 'Design', 'Active'),
(8, 'Marketing', 'Active'),
(9, 'Lifestyle', 'Active'),
(10, 'Photography & Video', 'Active'),
(11, 'Health & Fitness', 'Active'),
(12, 'Music', 'Active'),
(13, 'Teaching & Academics', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_completion`
--

CREATE TABLE `certificate_completion` (
  `certificate_id` int(11) NOT NULL,
  `certificate_unique_id` varchar(255) NOT NULL,
  `certificate_name` varchar(255) NOT NULL,
  `certificate_img` varchar(255) NOT NULL,
  `date_complete` varchar(30) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_unique_id` varchar(255) NOT NULL,
  `course_unique_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_completion`
--

INSERT INTO `certificate_completion` (`certificate_id`, `certificate_unique_id`, `certificate_name`, `certificate_img`, `date_complete`, `datetime`, `user_unique_id`, `course_unique_id`) VALUES
(18, 'Certificate6443b59a63462202304221682159002courseID64427102ac2101068313003', 'Certificate for completion of HTML CSS Course Zero to Hero', 'Certificate/Certificate6443b59a63462202304221682159002courseID64427102ac2101068313003.jpg', '22nd  April 2023 ', '2023-04-22 10:23:22', '1068313003', 'courseID64427102ac210');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_unique_id` varchar(250) NOT NULL,
  `course_title` varchar(250) NOT NULL,
  `course_subtitle` varchar(250) NOT NULL,
  `course_description` longtext NOT NULL,
  `course_requirement` text NOT NULL,
  `course_langugae` varchar(20) NOT NULL,
  `course_level` varchar(20) NOT NULL,
  `course_category` varchar(250) NOT NULL,
  `course_subcategory` varchar(250) NOT NULL,
  `course_teaching_outcome` longtext NOT NULL,
  `course_date` date NOT NULL,
  `course_latest_date` date NOT NULL,
  `course_status` varchar(20) NOT NULL,
  `course_price` varchar(250) NOT NULL,
  `preview_image` varchar(250) NOT NULL,
  `preview_video` varchar(250) NOT NULL,
  `instructor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_unique_id`, `course_title`, `course_subtitle`, `course_description`, `course_requirement`, `course_langugae`, `course_level`, `course_category`, `course_subcategory`, `course_teaching_outcome`, `course_date`, `course_latest_date`, `course_status`, `course_price`, `preview_image`, `preview_video`, `instructor_id`) VALUES
(40, 'courseID64427102ac210', 'HTML CSS Course Zero to Hero', 'Grab a pace to enter WebDevelopment!', 'This course is designed to provide students with a comprehensive understanding of HTML and CSS. The course will cover the basics of creating and designing web pages using HTML and CSS. Students will learn how to create and format text, images, tables, and forms using HTML, as well as how to style web pages using CSS. In addition, the course will cover topics such as responsive design, accessibility, and best practices for creating web pages.', 'Basic understanding of computer operations and file management\r\nAccess to a computer with an internet connection\r\nBasic knowledge of web browsing and web development', 'English', ' Beginner', '1', '1', 'Understand the fundamentals of HTML and CSS.\r\nCreate and format text, images, tables, and forms using HTML.\r\nApply different styles to web pages using CSS.\r\nUnderstand responsive design and create web pages that are optimized for different devices.\r\nCreate accessible web pages that can be used by people with disabilities.\r\nUnderstand best practices for creating and designing web pages.', '2023-04-21', '2023-04-21', 'published', '$19.99', 'assets/files/202304211682077200.jpg', 'assets/files/202304211682077200.mp4', 1292484688),
(41, 'courseID6442771223d8c', 'JavaScript Advanced ', 'Strong foundational knowledge of JavaScript ', 'This course is designed for students who have a strong foundational knowledge of JavaScript and are looking to advance their skills. The course will cover advanced topics such as object-oriented programming, asynchronous programming, data structures, and algorithms using JavaScript. Students will also learn about advanced concepts such as closures, scope, and the event loop. In addition, the course will cover best practices for writing efficient and maintainable JavaScript code.', 'Basic understanding of JavaScript\r\nUnderstanding of basic programming concepts\r\nAccess to a computer with an internet connection\r\nFamiliarity with text editors or Integrated Development Environments (IDEs)', 'English', ' Beginner', '1', '1', 'Understand advanced JavaScript concepts such as closures, scope, and the event loop.\r\nWrite efficient and maintainable JavaScript code using best practices.\r\nUse object-oriented programming principles to write modular code.\r\nCreate and use data structures and algorithms using JavaScript.\r\nUnderstand and implement asynchronous programming in JavaScript.\r\nDevelop JavaScript applications that interact with APIs and manipulate the Document Object Model (DOM).', '2023-04-21', '2023-04-21', 'published', '$24.99', 'assets/files/202304211682077691.jpg', 'assets/files/202304211682077691.mp4', 1292484688),
(42, 'courseID64427c8cae083', 'Cryptocurrency Beginner', ' A Beginner Guide to Understanding Cryptocurrency ', 'This course is designed for individuals who are new to the world of cryptocurrency and want to learn about the basics of this digital asset. The course will cover topics such as what is cryptocurrency, how it works, how to invest in cryptocurrency, and the risks involved in investing in cryptocurrency. Students will also learn about popular cryptocurrencies like Bitcoin, Ethereum, and Litecoin. The course will provide a comprehensive overview of the cryptocurrency market and will help students to make informed decisions about investing in this asset class.', 'Understand the basics of cryptocurrency and blockchain technology.\r\nIdentify and evaluate different cryptocurrencies.\r\nUnderstand the risks and benefits of investing in cryptocurrency.\r\nUnderstand the role of cryptocurrency exchanges and wallets.\r\nMake informed decisions about investing in cryptocurrency.', 'English', ' Beginner', '3', '18', 'Understand the basics of cryptocurrency and blockchain technology.\r\nIdentify and evaluate different cryptocurrencies.\r\nUnderstand the risks and benefits of investing in cryptocurrency.\r\nUnderstand the role of cryptocurrency exchanges and wallets.\r\nMake informed decisions about investing in cryptocurrency.', '2023-04-21', '2023-04-21', 'published', '$29.99', 'assets/files/202304211682081144.jpg', 'assets/files/202304211682081144.mp4', 1428740410),
(43, 'courseID64428627c5161', 'Leadership Development', 'Developing Leadership Skills for Effective Managem', 'This course is designed for individuals who want to enhance their leadership skills and abilities. The course will cover topics such as leadership styles, communication, decision making, team building, and conflict resolution. Students will learn how to build effective teams, develop strategies for goal achievement, and lead with confidence. The course will provide a comprehensive overview of leadership concepts, and will teach students how to apply these concepts to real-world situations.', 'No specific education or experience is required, although an interest in leadership is recommended.\r\nAccess to a computer with an internet connection\r\nFamiliarity with basic computer skills\r\nA willingness to learn and apply new concepts and strategies', 'Español', ' Intermediate', '6', '29', 'Understand the key concepts of leadership and management.\r\nDevelop effective leadership and communication skills.\r\nBuild and motivate high-performing teams.\r\nUse effective decision-making and problem-solving strategies.\r\nResolve conflicts and negotiate with others.\r\nDevelop strategies for goal achievement.', '2023-04-21', '2023-04-21', 'published', '$34.99', 'assets/files/202304211682081842.jpg', 'assets/files/202304211682081842.mp4', 1428740410),
(44, 'courseID6442896857652', 'Photographic Portrait Mastery', 'Capturing the Essence of People Through Photograph', 'This course is designed to teach students how to create stunning photographic portraits. Students will learn about lighting, composition, posing, and editing techniques to capture the essence of their subjects. The course will cover both technical and creative aspects of portrait photography, and students will gain the skills needed to create professional-quality portraits.', 'Access to a digital camera (DSLR or mirrorless preferred)\r\nBasic understanding of camera settings and operation\r\nFamiliarity with photo editing software (Adobe Photoshop or Lightroom preferred, but not required)\r\nWillingness to practice and experiment with portrait photography techniques', 'English', ' Beginner', '10', '38', 'Understand the principles of portrait photography, including lighting, composition, and posing.\r\nUse various lighting setups and modifiers to create different moods and effects in portraits.\r\nCommunicate with subjects and direct them to achieve the desired look and feel in a portrait.\r\nEdit portraits using basic photo editing techniques to enhance the final product.\r\nBuild a portfolio of stunning portrait photographs.', '2023-04-21', '2023-04-21', 'published', '$59.99', 'assets/files/202304211682082643.jpg', 'assets/files/202304211682082643.mp4', 925955527),
(45, 'courseID64428de219710', 'Digital Marketing Essentials', 'Professional Guide to Digital Marketing', 'This course provides a comprehensive introduction to the field of digital marketing. Students will learn about key digital marketing channels, including search engine optimization (SEO), pay-per-click (PPC) advertising, social media marketing, and email marketing. The course will cover the basics of creating a digital marketing strategy, including targeting, budgeting, and measuring success. By the end of the course, students will have a solid understanding of how to leverage digital marketing to increase brand awareness, generate leads, and drive sales.', 'No specific education or experience is required, although basic computer skills are recommended.\r\nAccess to a computer with an internet connection\r\nA willingness to learn and apply new concepts and strategies', 'English', ' Intermediate', '8', '33', 'Understand the fundamentals of digital marketing.\r\nCreate a digital marketing strategy for a business or organization.\r\nOptimize websites for search engines.\r\nDevelop and execute a pay-per-click advertising campaign.\r\nLeverage social media to increase brand awareness and engagement.\r\nCreate effective email marketing campaigns.\r\nMeasure the success of digital marketing campaigns.', '2023-04-21', '2023-04-21', 'published', 'Free', 'assets/files/202304211682083687.jpg', 'assets/files/202304211682083687.mp4', 925955527),
(46, 'courseID644295bc4b604', 'Python Beginner', 'For Wide Range of Python Development', 'This course is designed to provide students with a comprehensive understanding of Python. The course will cover the basics of creating and designing web pages using Python and Django. Students will learn how to create and format text, images, tables, and forms using HTML, as well as how to style web pages using CSS. In addition, the course will cover topics such as responsive design, accessibility, and best practices for creating web pages.', 'Basic understanding of computer operations and file management\r\nAccess to a computer with an internet connection\r\nBasic knowledge of web browsing and web development', 'English', ' Intermediate', '1', '1', 'Understand the fundamentals of Python and Django.\r\nCreate and format text, images, tables, and forms using HTML.\r\nApply different styles to web pages using CSS.\r\nUnderstand responsive design and create web pages that are optimized for different devices.\r\nCreate accessible web pages that can be used by people with disabilities.\r\nUnderstand best practices for creating and designing web pages.', '2023-04-21', '2023-04-21', 'published', 'Free', 'assets/files/202304211682085512.jpg', 'assets/files/202304211682085512.mp4', 1433005905),
(47, 'courseID644297011d336', 'WordPress 101', 'Ease of Creating of Website', 'This course is designed to provide students with a comprehensive understanding of HTML and CSS. The course will cover the basics of creating and designing web pages using HTML and CSS. Students will learn how to create and format text, images, tables, and forms using HTML, as well as how to style web pages using CSS. In addition, the course will cover topics such as responsive design, accessibility, and best practices for creating web pages.', 'Basic understanding of computer operations and file management\r\nAccess to a computer with an internet connection\r\nBasic knowledge of web browsing and web development', 'English', ' Beginner', '1', '1', 'Understand the fundamentals of Wordpress.\r\nCreate and format text, images, tables, and forms using HTML.\r\nApply different styles to web pages using CSS.\r\nUnderstand responsive design and create web pages that are optimized for different devices.\r\nCreate accessible web pages that can be used by people with disabilities.\r\nUnderstand best practices for creating and designing web pages.', '2023-04-21', '2023-04-21', 'published', 'Free', 'assets/files/202304211682085792.jpg', 'assets/files/202304211682085792.mp4', 1433005905),
(48, 'courseID6442989898aa6', 'Laravel zero to hero', 'Begin your MVC modal development', 'This course is designed for students who have a strong foundational knowledge of JavaScript and are looking to advance their skills. The course will cover advanced topics such as object-oriented programming, asynchronous programming, data structures, and algorithms using JavaScript. Students will also learn about advanced concepts such as closures, scope, and the event loop. In addition, the course will cover best practices for writing efficient and maintainable JavaScript code.', 'Basic understanding of JavaScript\r\nUnderstanding of basic programming concepts\r\nAccess to a computer with an internet connection\r\nFamiliarity with text editors or Integrated Development Environments (IDEs)\r\n', 'English', ' Beginner', '1', '1', 'Understand advanced JavaScript concepts such as closures, scope, and the event loop.\r\nWrite efficient and maintainable JavaScript code using best practices.\r\nUse object-oriented programming principles to write modular code.\r\nCreate and use data structures and algorithms using JavaScript.\r\nUnderstand and implement asynchronous programming in JavaScript.\r\nDevelop JavaScript applications that interact with APIs and manipulate the Document Object Model (DOM).', '2023-04-21', '2023-04-21', 'published', 'Free', 'assets/files/laravel.jpg', 'assets/files/202304211682086395.mp4', 284258889),
(51, 'courseID64435816acf07', 'React JS for Beginners', 'Building Modern Web Applications with React JS', 'This course is designed for individuals who want to learn how to build modern web applications using React JS. Students will learn the basics of React JS, including components, props, state, and event handling. The course will cover React key features, such as JSX, virtual DOM, and lifecycle methods. Students will also learn how to use React with other technologies, such as Redux and Node.js. By the end of the course, students will have the skills and knowledge to build their own web applications using React JS.', 'Basic knowledge of HTML, CSS, and JavaScript is recommended\r\nAccess to a computer with an internet connection\r\nFamiliarity with basic computer skills\r\nA willingness to learn and apply new concepts and strategies', 'English', ' Beginner', '1', '1', 'Understand the basics of React JS and its key features.\r\nCreate and manage components in React.\r\nManage state and props in React.\r\nUnderstand how to use React with other technologies, such as Redux and Node.js.\r\nBuild modern web applications using React JS.', '2023-04-22', '2023-04-22', 'published', 'Free', 'assets/files/202304221682139099.jpg', 'assets/files/202304221682139099.mp4', 284258889);

-- --------------------------------------------------------

--
-- Table structure for table `coursecomplete`
--

CREATE TABLE `coursecomplete` (
  `complete_id` int(11) NOT NULL,
  `user_unique_id` varchar(255) NOT NULL,
  `course_unique_id` varchar(255) NOT NULL,
  `video_unique_id` varchar(255) NOT NULL,
  `quizPack_unique_id` varchar(255) NOT NULL,
  `date_complete` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursecomplete`
--

INSERT INTO `coursecomplete` (`complete_id`, `user_unique_id`, `course_unique_id`, `video_unique_id`, `quizPack_unique_id`, `date_complete`) VALUES
(52, '1068313003', 'courseID64427102ac210', '202304211682076080', '', '2023-04-22 10:04:52'),
(53, '1068313003', 'courseID64427102ac210', '202304211682076133', '', '2023-04-22 10:11:33'),
(54, '1068313003', 'courseID64427102ac210', '202304211682076569', '', '2023-04-22 10:11:41'),
(55, '1068313003', 'courseID64427102ac210', '202304211682076608', '', '2023-04-22 10:11:47'),
(56, '1068313003', 'courseID64427102ac210', '', '20230421168207680086Quiz 1', '2023-04-22 10:12:09'),
(58, '1068313003', 'courseID64427102ac210', '202304211682077120', '', '2023-04-22 10:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `coursequiz`
--

CREATE TABLE `coursequiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_question` varchar(250) NOT NULL,
  `quiz_json` text NOT NULL,
  `option1` varchar(250) NOT NULL,
  `option2` varchar(250) NOT NULL,
  `option3` varchar(250) NOT NULL,
  `option4` varchar(250) NOT NULL,
  `correct_option` varchar(250) NOT NULL,
  `upload_date` varchar(250) NOT NULL,
  `update_date` varchar(250) NOT NULL,
  `quizPackage_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursequiz`
--

INSERT INTO `coursequiz` (`quiz_id`, `quiz_question`, `quiz_json`, `option1`, `option2`, `option3`, `option4`, `correct_option`, `upload_date`, `update_date`, `quizPackage_id`) VALUES
(50, 'What does HTML stand for?', '[{\"q\":\"What does HTML stand for?\",\"options\":[\"Hypertext Markup Language\",\"Hyper Text Media Language`\",\"Hyperlinks and Text Markup Language\",\"Home Text Markup Language\"],\"answer\":\"0\"}]', 'Hypertext Markup Language', 'Hyper Text Media Language`', 'Hyperlinks and Text Markup Language', 'Home Text Markup Language', '0', '2023-04-21 06:06:34', '2023-04-21 06:06:34', '20230421168207680086Quiz 1'),
(51, 'Which tag is used to create headings in HTML?', '[{\"q\":\"Which tag is used to create headings in HTML?\",\"options\":[\"h1 tag\",\" p tag\",\"b tag\",\" title tag\"],\"answer\":\"0\"}]', 'h1 tag', 'p tag', 'b tag', 'title tag', '0', '2023-04-21 06:07:06', '2023-04-21 06:07:06', '20230421168207680086Quiz 1'),
(52, 'Which tag is used to create a hyperlink in HTML?', '[{\"q\":\"Which tag is used to create a hyperlink in HTML?\",\"options\":[\"a tag\",\"link tag\",\"img tag\",\"meta tag\"],\"answer\":\"0\"}]', 'a tag', 'link tag', 'img link', 'meta link', '0', '2023-04-21 06:08:13', '2023-04-21 06:08:13', '20230421168207680086Quiz 1'),
(53, 'Which tag is used to create a text input field in HTML?`', '[{\"q\":\"Which tag is used to create a text input field in HTML?`\",\"options\":[\"<input type=\"text\">\",\" <input type=\"password\">\",\" <input type=\"submit\">\",\"<input type=\"checkbox\">\"],\"answer\":\"0\"}]', '<input type=\"text\">', ' <input type=\"password\">', ' <input type=\"submit\">', '<input type=\"checkbox\">', '0', '2023-04-21 06:16:28', '2023-04-21 06:16:28', '20230421168207755734 HTML Forms'),
(54, 'Which attribute is used to specify the name of a form element in HTML?', '[{\"q\":\"Which attribute is used to specify the name of a form element in HTML?\",\"options\":[\"name\",\"type\",\"value\",\"id\"],\"answer\":\"0\"}]', 'name', 'type', 'value', 'id', '0', '2023-04-21 06:17:03', '2023-04-21 06:17:03', '20230421168207755734 HTML Forms'),
(55, 'What is cryptocurrency?', '[{\"q\":\"What is cryptocurrency?\",\"options\":[\"A physical currency used to buy goods and services\",\"A digital or virtual currency that uses cryptography for security\",\" A currency used only for online transactions\",\" A currency backed by a central bank\"],\"answer\":\"1\"}]', 'A physical currency used to buy goods and services', 'A digital or virtual currency that uses cryptography for security', ' A currency used only for online transactions', ' A currency backed by a central bank', '1', '2023-04-21 07:11:27', '2023-04-21 07:11:27', '20230421168208080591Quiz 1'),
(56, 'What is blockchain?', '[{\"q\":\"What is blockchain?\",\"options\":[\"A digital ledger that records cryptocurrency transactions\",\" A type of encryption used in cryptocurrency\",\"A type of cryptocurrency wallet\",\" An online marketplace for buying and selling cryptocurrency\"],\"answer\":\"0\"}]', 'A digital ledger that records cryptocurrency transactions', ' A type of encryption used in cryptocurrency', 'A type of cryptocurrency wallet', ' An online marketplace for buying and selling cryptocurrency', '0', '2023-04-21 07:12:17', '2023-04-21 07:12:17', '20230421168208080591Quiz 1'),
(57, 'What is the most well-known cryptocurrency?', '[{\"q\":\"What is the most well-known cryptocurrency?\",\"options\":[\"Ripple\",\"Litecoin\",\"Bitcoin\",\"Ethereum\"],\"answer\":\"2\"}]', 'Ripple', 'Litecoin', 'Bitcoin', 'Ethereum', '2', '2023-04-21 07:12:54', '2023-04-21 07:12:54', '20230421168208080591Quiz 1'),
(58, 'What is the process of verifying cryptocurrency transactions called?', '[{\"q\":\"What is the process of verifying cryptocurrency transactions called?\",\"options\":[\"Mining\",\"Hashing\",\"Encryption\",\"Encryption\"],\"answer\":\"0\"}]', 'Mining', 'Hashing', 'Encryption', 'Encryption', '0', '2023-04-21 07:13:38', '2023-04-21 07:13:38', '20230421168208080591Quiz 1'),
(59, 'Which of the following is a leadership style where the leader makes all the decisions?', '[{\"q\":\"Which of the following is a leadership style where the leader makes all the decisions?\",\"options\":[\"Autocratic\",\"Autocratic\",\"Laissez-faire\",\"Laissez-faire\"],\"answer\":\"0\"}]', 'Autocratic', 'Autocratic', 'Laissez-faire', 'Laissez-faire', '0', '2023-04-21 07:23:26', '2023-04-21 07:23:26', '20230421168208156740Quiz1 '),
(60, 'What is the process of communicating a vision or idea to others called?', '[{\"q\":\"What is the process of communicating a vision or idea to others called?\",\"options\":[\"Feedback\",\"Empathy\",\" Active listening\",\". Vision casting\"],\"answer\":\"3\"}]', 'Feedback', 'Empathy', ' Active listening', '. Vision casting', '3', '2023-04-21 07:24:03', '2023-04-21 07:24:03', '20230421168208156740Quiz1 '),
(61, 'What is the primary consideration when choosing a location for a portrait shoot?', '[{\"q\":\"What is the primary consideration when choosing a location for a portrait shoot?\",\"options\":[\"Lighting\",\"Background\",\"Pose\",\"Camera settings\"],\"answer\":\"0\"}]', 'Lighting', 'Background', 'Pose', 'Camera settings', '0', '2023-04-21 07:37:08', '2023-04-21 07:37:08', '20230421168208237894Quiz1'),
(62, 'What is the best time of day to take outdoor portraits?', '[{\"q\":\"What is the best time of day to take outdoor portraits?\",\"options\":[\"Early morning\",\"Midday\",\"Late afternoon\",\"Nighttime\"],\"answer\":\"2\"}]', 'Early morning', 'Midday', 'Late afternoon', 'Nighttime', '2', '2023-04-21 07:38:07', '2023-04-21 07:38:07', '20230421168208237894Quiz1'),
(63, 'Which is a digital marketing using social media? ', '[{\"q\":\"Which is a digital marketing using social media? \",\"options\":[\"Search engine optimization (SEO)\",\" Pay-per-click (PPC) advertising\",\"Social media marketing\",\"Email marketing\"],\"answer\":\"2\"}]', 'Search engine optimization (SEO)', ' Pay-per-click (PPC) advertising', 'Social media marketing', 'Email marketing', '2', '2023-04-21 07:54:02', '2023-04-21 07:54:02', '20230421168208336415Quiz 1'),
(64, 'Marketing where each time a user clicks pay?', '[{\"q\":\"Marketing where each time a user clicks pay?\",\"options\":[\"Search engine optimization (SEO)\",\"Pay-per-click (PPC) advertising\",\"Social media marketing\",\"Email marketing\"],\"answer\":\"1\"}]', 'Search engine optimization (SEO)', 'Pay-per-click (PPC) advertising', 'Social media marketing', 'Email marketing', '1', '2023-04-21 07:55:22', '2023-04-21 07:55:22', '20230421168208336415Quiz 1'),
(65, 'Which attribute is used to specify the width of an input field in HTML?', '[{\"q\":\"Which attribute is used to specify the width of an input field in HTML?\",\"options\":[\"width\",\"size\",\"length\",\"height\"],\"answer\":\"0\"}]', 'width', 'size', 'length', 'height', '0', '2023-04-21 08:27:48', '2023-04-21 08:27:48', '20230421168208544915Quiz 1'),
(70, 'What is React JS?', '[{\"q\":\"What is React JS?\",\"options\":[\"A programming language\",\"A web framework\",\"A JavaScript library\",\" A content management system\"],\"answer\":\"2\"}]', 'A programming language', 'A web framework', 'A JavaScript library', ' A content management system', '2', '2023-04-22 11:11:31', '2023-04-22 11:11:31', '20230422168213846548Quiz 1');

-- --------------------------------------------------------

--
-- Table structure for table `coursevideo`
--

CREATE TABLE `coursevideo` (
  `video_id` int(11) NOT NULL,
  `video_unique_id` varchar(250) NOT NULL,
  `video_name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `youtube_link` varchar(250) NOT NULL,
  `video_type` varchar(250) NOT NULL,
  `runTime` int(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `upload_date` varchar(250) NOT NULL,
  `update_date` varchar(250) NOT NULL,
  `order_toshow_content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursevideo`
--

INSERT INTO `coursevideo` (`video_id`, `video_unique_id`, `video_name`, `location`, `youtube_link`, `video_type`, `runTime`, `course_id`, `upload_date`, `update_date`, `order_toshow_content`) VALUES
(87, '202304211682076080', 'HTML Introduction', '', 'https://www.youtube.com/watch?v=dD2EISBDjWM&list=PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB&ab_channel=EJMedia', 'youtubeVideo', 4, 40, '2023-04-21 05:51:20', '2023-04-21 05:51:20', 0),
(88, '202304211682076133', 'HTML Tutorial for Beginners - 01 - Creating the first web page', '', 'https://www.youtube.com/watch?v=-USAeFpVf_A&list=PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB&index=2&ab_channel=EJMedia', 'youtubeVideo', 10, 40, '2023-04-21 05:52:13', '2023-04-21 05:52:13', 0),
(89, '202304211682076569', 'HTML Video 1', 'assets/files/202304211682076569.mp4', '', 'UploadedVideo', 100, 40, '2023-04-21 05:59:29', '2023-04-21 05:59:29', 0),
(90, '202304211682076608', 'HTML Video 2', 'assets/files/202304211682076608.mp4', '', 'UploadedVideo', 100, 40, '2023-04-21 06:00:08', '2023-04-21 06:00:08', 0),
(92, '202304211682077120', 'Video 3', '', 'https://www.youtube.com/watch?v=dD2EISBDjWM&list=PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB&ab_channel=EJMedia', 'youtubeVideo', 100, 40, '2023-04-21 06:08:40', '2023-04-21 06:08:40', 0),
(93, '202304211682077496', 'Video 1', 'assets/files/202304211682077496.mp4', '', 'UploadedVideo', 100, 41, '2023-04-21 06:14:56', '2023-04-21 06:14:56', 0),
(94, '202304211682077517', 'Video 2', '', 'https://www.youtube.com/watch?v=dD2EISBDjWM&list=PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB&ab_channel=EJMedia', 'youtubeVideo', 100, 41, '2023-04-21 06:15:17', '2023-04-21 06:15:17', 0),
(95, '202304211682077533', 'Video 3', '', 'https://www.youtube.com/watch?v=dD2EISBDjWM&list=PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB&ab_channel=EJMedia', 'youtubeVideo', 9, 41, '2023-04-21 06:15:33', '2023-04-21 06:15:33', 0),
(96, '202304211682077656', 'Video 4', 'assets/files/202304211682077656.mp4', '', 'UploadedVideo', 200, 41, '2023-04-21 06:17:36', '2023-04-21 06:17:36', 0),
(97, '202304211682077673', 'Video 5', '', 'https://www.youtube.com/watch?v=dD2EISBDjWM&list=PLr6-GrHUlVf_ZNmuQSXdS197Oyr1L9sPB&ab_channel=EJMedia', 'youtubeVideo', 10, 41, '2023-04-21 06:17:53', '2023-04-21 06:17:53', 0),
(98, '202304211682078880', 'Video 1', 'assets/files/202304211682078880.mp4', '', 'UploadedVideo', 10, 42, '2023-04-21 06:38:00', '2023-04-21 06:38:00', 0),
(99, '202304211682078897', 'Video 2', '', 'https://www.youtube.com/watch?v=1YyAzVmP9xQ&ab_channel=Simplilearn', 'youtubeVideo', 100, 42, '2023-04-21 06:38:17', '2023-04-21 06:38:17', 0),
(100, '202304211682078913', 'Video 3', 'assets/files/202304211682078913.mp4', '', 'UploadedVideo', 100, 42, '2023-04-21 06:38:33', '2023-04-21 06:38:33', 0),
(101, '202304211682078931', 'Video4', '', 'https://www.youtube.com/watch?v=1YyAzVmP9xQ&ab_channel=Simplilearn', 'youtubeVideo', 12, 42, '2023-04-21 06:38:51', '2023-04-21 06:38:51', 0),
(102, '202304211682081045', 'Video 5', '', 'https://www.youtube.com/watch?v=1YyAzVmP9xQ&ab_channel=Simplilearn', 'youtubeVideo', 13, 42, '2023-04-21 07:14:05', '2023-04-21 07:14:05', 0),
(103, '202304211682081513', 'Video 1', 'assets/files/202304211682081513.mp4', '', 'UploadedVideo', 100, 43, '2023-04-21 07:21:53', '2023-04-21 07:21:53', 0),
(104, '202304211682081528', 'Video 2', 'assets/files/202304211682081528.mp4', '', 'UploadedVideo', 100, 43, '2023-04-21 07:22:08', '2023-04-21 07:22:08', 0),
(105, '202304211682081551', 'Video 3', '', 'https://www.youtube.com/watch?v=XQe_c4bdD6w&ab_channel=UseyourSpanish', 'youtubeVideo', 12, 43, '2023-04-21 07:22:31', '2023-04-21 07:22:31', 0),
(106, '202304211682081690', 'Video 4', 'assets/files/202304211682081690.mp4', '', 'UploadedVideo', 20, 43, '2023-04-21 07:24:50', '2023-04-21 07:24:50', 0),
(107, '202304211682081729', 'Video 5', '', 'https://www.youtube.com/watch?v=XQe_c4bdD6w&ab_channel=UseyourSpanish', 'youtubeVideo', 13, 43, '2023-04-21 07:25:29', '2023-04-21 07:25:29', 0),
(108, '202304211682082262', 'Video 1', '', 'https://www.youtube.com/watch?v=fkZTf0Ifxwg&ab_channel=TheSchoolofPhotography', 'youtubeVideo', 100, 44, '2023-04-21 07:34:22', '2023-04-21 07:34:22', 0),
(109, '202304211682082287', 'Video 2', '', 'https://www.youtube.com/watch?v=f2XsQkuAsaU&ab_channel=PatKay', 'youtubeVideo', 100, 44, '2023-04-21 07:34:47', '2023-04-21 07:34:47', 0),
(110, '202304211682082516', 'Video 3', '', 'https://www.youtube.com/watch?v=f2XsQkuAsaU&ab_channel=PatKay', 'youtubeVideo', 100, 44, '2023-04-21 07:38:36', '2023-04-21 07:38:36', 0),
(111, '202304211682082531', 'Video 4', '', 'https://www.youtube.com/watch?v=f2XsQkuAsaU&ab_channel=PatKay', 'youtubeVideo', 6, 44, '2023-04-21 07:38:51', '2023-04-21 07:38:51', 0),
(112, '202304211682082577', 'VIdeo 5', '', 'https://www.youtube.com/watch?v=f2XsQkuAsaU&ab_channel=PatKay', 'youtubeVideo', 20, 44, '2023-04-21 07:39:37', '2023-04-21 07:39:37', 0),
(113, '202304211682083316', 'Video 1', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 100, 45, '2023-04-21 07:51:56', '2023-04-21 07:51:56', 0),
(114, '202304211682083346', 'VIdeo 2', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 100, 45, '2023-04-21 07:52:26', '2023-04-21 07:52:26', 0),
(115, '202304211682083540', 'Video 3', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 23, 45, '2023-04-21 07:55:40', '2023-04-21 07:55:40', 0),
(116, '202304211682083558', 'Video 4', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 34, 45, '2023-04-21 07:55:58', '2023-04-21 07:55:58', 0),
(117, '202304211682083576', 'VIdeo 5', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 32, 45, '2023-04-21 07:56:16', '2023-04-21 07:56:16', 0),
(118, '202304211682085334', 'Video 1', 'assets/files/202304211682085334.mp4', '', 'UploadedVideo', 100, 46, '2023-04-21 08:25:34', '2023-04-21 08:25:34', 0),
(119, '202304211682085350', 'Video 2', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 100, 46, '2023-04-21 08:25:50', '2023-04-21 08:25:50', 0),
(120, '202304211682085391', 'VIdeo 2', 'assets/files/202304211682085391.mp4', '', 'UploadedVideo', 100, 46, '2023-04-21 08:26:31', '2023-04-21 08:26:31', 0),
(121, '202304211682085418', 'Video 4', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 42, 46, '2023-04-21 08:26:58', '2023-04-21 08:26:58', 0),
(122, '202304211682085488', 'Video 5', 'assets/files/202304211682085488.mp4', '', 'UploadedVideo', 12, 46, '2023-04-21 08:28:08', '2023-04-21 08:28:08', 0),
(123, '202304211682085667', 'video 1', 'assets/files/202304211682085667.mp4', '', 'UploadedVideo', 100, 47, '2023-04-21 08:31:07', '2023-04-21 08:31:07', 0),
(124, '202304211682085719', 'Video 2', 'assets/files/202304211682085719.mp4', '', 'UploadedVideo', 100, 47, '2023-04-21 08:31:59', '2023-04-21 08:31:59', 0),
(125, '202304211682085734', 'Video 3', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 32, 47, '2023-04-21 08:32:14', '2023-04-21 08:32:14', 0),
(126, '202304211682085754', 'Video 4', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 14, 47, '2023-04-21 08:32:34', '2023-04-21 08:32:34', 0),
(127, '202304211682085775', 'Video 5', 'assets/files/202304211682085775.mp4', '', 'UploadedVideo', 54, 47, '2023-04-21 08:32:55', '2023-04-21 08:32:55', 0),
(128, '202304211682086061', 'Video 1', 'assets/files/202304211682086061.mp4', '', 'UploadedVideo', 100, 48, '2023-04-21 08:37:41', '2023-04-21 08:37:41', 0),
(129, '202304211682086327', 'Video 2', 'assets/files/202304211682086327.mp4', '', 'UploadedVideo', 100, 48, '2023-04-21 08:42:07', '2023-04-21 08:42:07', 0),
(130, '202304211682086343', 'Video 3', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 19, 48, '2023-04-21 08:42:23', '2023-04-21 08:42:23', 0),
(131, '202304211682086359', 'Video 4', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 39, 48, '2023-04-21 08:42:39', '2023-04-21 08:42:39', 0),
(132, '202304211682086380', 'Video 5', '', 'https://www.youtube.com/watch?v=bixR-KIJKYM&ab_channel=Simplilearn', 'youtubeVideo', 67, 48, '2023-04-21 08:43:00', '2023-04-21 08:43:00', 0),
(139, '202304221682138391', 'Video Intro', '', 'https://www.youtube.com/watch?v=N3AkSS5hXMA&ab_channel=ProgrammingwithMosh', 'youtubeVideo', 10, 51, '2023-04-22 11:09:51', '2023-04-22 11:09:51', 0),
(140, '202304221682138421', 'Video 1', 'assets/files/202304221682138421.mp4', '', 'UploadedVideo', 100, 51, '2023-04-22 11:10:21', '2023-04-22 11:10:21', 0),
(141, '202304221682138438', 'Video 2', 'assets/files/202304221682138438.mp4', '', 'UploadedVideo', 100, 51, '2023-04-22 11:10:38', '2023-04-22 11:10:38', 0),
(142, '202304221682138457', 'Video 3', 'assets/files/202304221682138457.mp4', '', 'UploadedVideo', 13, 51, '2023-04-22 11:10:57', '2023-04-22 11:10:57', 0),
(143, '202304221682138508', 'Video 4', 'assets/files/202304221682138508.mp4', '', 'UploadedVideo', 12, 51, '2023-04-22 11:11:48', '2023-04-22 11:11:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `unique_id` int(200) NOT NULL,
  `profile_networth` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `unique_id`, `profile_networth`) VALUES
(20, 1292484688, '76'),
(21, 1428740410, '92'),
(22, 925955527, '59'),
(23, 1433005905, '0'),
(24, 284258889, '0'),
(25, 1068313003, '0');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `msg_time`) VALUES
(59, 284258889, 1292484688, 'Hi i am your instructor, how may i help you', '2023-04-22 08:24:27'),
(60, 1428740410, 1292484688, 'hi', '2023-04-22 08:24:40'),
(61, 1292484688, 1068313003, 'hi', '2023-04-22 11:26:44'),
(62, 1292484688, 1068313003, 'hi', '2023-04-22 11:29:40'),
(63, 1292484688, 1068313003, 'hi mate', '2023-04-23 07:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_toshow_content`
--

CREATE TABLE `order_toshow_content` (
  `contentOrderID` int(11) NOT NULL,
  `course_unique_id` varchar(250) NOT NULL,
  `content_type` enum('video','quiz') NOT NULL,
  `video_unique_id` varchar(250) NOT NULL,
  `quizPackage_unique_id` varchar(250) NOT NULL,
  `order_toshow_content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_toshow_content`
--

INSERT INTO `order_toshow_content` (`contentOrderID`, `course_unique_id`, `content_type`, `video_unique_id`, `quizPackage_unique_id`, `order_toshow_content`) VALUES
(93, 'courseID64427102ac210', 'video', '202304211682076080', '', 0),
(94, 'courseID64427102ac210', 'video', '202304211682076133', '', 1),
(95, 'courseID64427102ac210', 'video', '202304211682076569', '', 2),
(96, 'courseID64427102ac210', 'video', '202304211682076608', '', 3),
(98, 'courseID64427102ac210', 'quiz', '', '20230421168207680086Quiz 1', 4),
(99, 'courseID64427102ac210', 'video', '202304211682077120', '', 5),
(100, 'courseID6442771223d8c', 'video', '202304211682077496', '', 0),
(101, 'courseID6442771223d8c', 'video', '202304211682077517', '', 1),
(102, 'courseID6442771223d8c', 'video', '202304211682077533', '', 2),
(103, 'courseID6442771223d8c', 'quiz', '', '20230421168207755734 HTML Forms', 3),
(104, 'courseID6442771223d8c', 'video', '202304211682077656', '', 4),
(105, 'courseID6442771223d8c', 'video', '202304211682077673', '', 5),
(106, 'courseID64427c8cae083', 'video', '202304211682078880', '', 0),
(107, 'courseID64427c8cae083', 'video', '202304211682078897', '', 1),
(108, 'courseID64427c8cae083', 'video', '202304211682078913', '', 2),
(109, 'courseID64427c8cae083', 'video', '202304211682078931', '', 3),
(110, 'courseID64427c8cae083', 'quiz', '', '20230421168208080591Quiz 1', 4),
(111, 'courseID64427c8cae083', 'video', '202304211682081045', '', 5),
(112, 'courseID64428627c5161', 'video', '202304211682081513', '', 0),
(113, 'courseID64428627c5161', 'video', '202304211682081528', '', 1),
(114, 'courseID64428627c5161', 'video', '202304211682081551', '', 2),
(115, 'courseID64428627c5161', 'quiz', '', '20230421168208156740Quiz1 ', 3),
(116, 'courseID64428627c5161', 'video', '202304211682081690', '', 4),
(117, 'courseID64428627c5161', 'video', '202304211682081729', '', 5),
(118, 'courseID6442896857652', 'video', '202304211682082262', '', 0),
(119, 'courseID6442896857652', 'video', '202304211682082287', '', 1),
(120, 'courseID6442896857652', 'quiz', '', '20230421168208237894Quiz1', 2),
(121, 'courseID6442896857652', 'video', '202304211682082516', '', 3),
(122, 'courseID6442896857652', 'video', '202304211682082531', '', 4),
(123, 'courseID6442896857652', 'video', '202304211682082577', '', 5),
(124, 'courseID64428de219710', 'video', '202304211682083316', '', 0),
(125, 'courseID64428de219710', 'video', '202304211682083346', '', 1),
(126, 'courseID64428de219710', 'quiz', '', '20230421168208336415Quiz 1', 2),
(127, 'courseID64428de219710', 'video', '202304211682083540', '', 3),
(128, 'courseID64428de219710', 'video', '202304211682083558', '', 4),
(129, 'courseID64428de219710', 'video', '202304211682083576', '', 5),
(130, 'courseID644295bc4b604', 'video', '202304211682085334', '', 0),
(131, 'courseID644295bc4b604', 'video', '202304211682085350', '', 1),
(132, 'courseID644295bc4b604', 'video', '202304211682085391', '', 2),
(133, 'courseID644295bc4b604', 'video', '202304211682085418', '', 3),
(134, 'courseID644295bc4b604', 'quiz', '', '20230421168208544915Quiz 1', 4),
(135, 'courseID644295bc4b604', 'video', '202304211682085488', '', 5),
(136, 'courseID644297011d336', 'video', '202304211682085667', '', 0),
(137, 'courseID644297011d336', 'video', '202304211682085719', '', 1),
(138, 'courseID644297011d336', 'video', '202304211682085734', '', 2),
(139, 'courseID644297011d336', 'video', '202304211682085754', '', 3),
(140, 'courseID644297011d336', 'video', '202304211682085775', '', 4),
(141, 'courseID6442989898aa6', 'video', '202304211682086061', '', 0),
(142, 'courseID6442989898aa6', 'video', '202304211682086327', '', 1),
(143, 'courseID6442989898aa6', 'video', '202304211682086343', '', 2),
(144, 'courseID6442989898aa6', 'video', '202304211682086359', '', 3),
(145, 'courseID6442989898aa6', 'video', '202304211682086380', '', 4),
(160, 'courseID64435816acf07', 'video', '202304221682138391', '', 0),
(161, 'courseID64435816acf07', 'video', '202304221682138421', '', 1),
(162, 'courseID64435816acf07', 'video', '202304221682138438', '', 2),
(163, 'courseID64435816acf07', 'video', '202304221682138457', '', 3),
(164, 'courseID64435816acf07', 'quiz', '', '20230422168213846548Quiz 1', 4),
(165, 'courseID64435816acf07', 'video', '202304221682138508', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_unique_id` varchar(255) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `VAT` decimal(10,0) NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `card_holder_name` varchar(50) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `card_transaction_no` varchar(255) NOT NULL,
  `bank_transfer_name` varchar(255) NOT NULL,
  `bank_transfer_receipt` varchar(255) NOT NULL,
  `bank_transaction_no` text NOT NULL,
  `bank_transaction_account` varchar(255) NOT NULL,
  `transfer_bank` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `purchase_day` int(11) NOT NULL,
  `purchase_month` varchar(25) NOT NULL,
  `purchase_year` int(11) NOT NULL,
  `purchase_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_unique_id`, `unique_id`, `user_id`, `total_amount`, `VAT`, `grand_total`, `payment_type`, `status`, `card_holder_name`, `customer_email`, `card_transaction_no`, `bank_transfer_name`, `bank_transfer_receipt`, `bank_transaction_no`, `bank_transaction_account`, `transfer_bank`, `country`, `purchase_day`, `purchase_month`, `purchase_year`, `purchase_time`) VALUES
(72, 'Purchase64429a4ecc59d2023-04-21 16:14:38284258889', 284258889, 42, '45', '2', '48', 'BankTransfer', 'succeeded', '', ' IsabellaBaker@gmail.com', '', ' Isabella Baker', '', '333333333333333333333333333333', '', 'AYA Bank', '', 21, 'Apr', 2023, '2023-04-21 14:14:38'),
(73, 'Purchase64429a86988ed2023-04-21 16:15:34284258889', 284258889, 42, '125', '6', '132', 'BankTransfer', 'succeeded', '', ' IsabellaBaker@gmail.com', '', ' Isabella Baker', '', '111111111111111111111111111111', '', 'KBZ Bank', '', 21, 'Apr', 2023, '2023-04-21 14:15:34'),
(74, 'pi_3MzcrkJ0ayPYJ2ci1Vc9bdX22023-04-22 11:36:311068313003', 1068313003, 44, '45', '2', '48', 'CreditCard', 'succeeded', 'MyatMin', 'myatmin@gmail.com', 'pi_3MzcrkJ0ayPYJ2ci1Vc9bdX2', '', '', '', '', '', '', 22, 'Apr', 2023, '2023-04-21 14:15:34'),
(75, 'pi_3MzxjSJ0ayPYJ2ci1ahx8maF2023-04-23 09:53:191068313003', 1068313003, 44, '30', '1', '32', 'CreditCard', 'succeeded', 'hhh', 'admin@email.com', 'pi_3MzxjSJ0ayPYJ2ci1ahx8maF', '', '', '', '', '', '', 23, 'Apr', 2023, '2023-04-23 07:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `purchase_unique_id` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_price` varchar(255) NOT NULL,
  `user_unique_id` varchar(255) NOT NULL,
  `instructor_unique_id` varchar(255) NOT NULL,
  `purchase_day` int(11) NOT NULL,
  `purchase_month` varchar(25) NOT NULL,
  `purchase_year` int(11) NOT NULL,
  `purchase_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`purchase_unique_id`, `course_id`, `course_price`, `user_unique_id`, `instructor_unique_id`, `purchase_day`, `purchase_month`, `purchase_year`, `purchase_time`) VALUES
('pi_3MzcrkJ0ayPYJ2ci1Vc9bdX22023-04-22 11:36:311068313003', 40, '$19.99', '1068313003', '1292484688', 22, 'Apr', 2023, '2023-04-22 09:36:31'),
('pi_3MzcrkJ0ayPYJ2ci1Vc9bdX22023-04-22 11:36:311068313003', 41, '$24.99', '1068313003', '1292484688', 22, 'Apr', 2023, '2023-04-22 09:36:31'),
('pi_3MzxjSJ0ayPYJ2ci1ahx8maF2023-04-23 09:53:191068313003', 42, '$29.99', '1068313003', '1428740410', 23, 'Apr', 2023, '2023-04-23 07:53:19'),
('Purchase64429a4ecc59d2023-04-21 16:14:38284258889', 40, '$19.99', '284258889', '1292484688', 21, 'Apr', 2023, '2023-04-21 14:14:38'),
('Purchase64429a4ecc59d2023-04-21 16:14:38284258889', 41, '$24.99', '284258889', '1292484688', 21, 'Apr', 2023, '2023-04-21 14:14:38'),
('Purchase64429a86988ed2023-04-21 16:15:34284258889', 42, '$29.99', '284258889', '1428740410', 21, 'Apr', 2023, '2023-04-21 14:15:34'),
('Purchase64429a86988ed2023-04-21 16:15:34284258889', 43, '$34.99', '284258889', '1428740410', 21, 'Apr', 2023, '2023-04-21 14:15:34'),
('Purchase64429a86988ed2023-04-21 16:15:34284258889', 44, '$59.99', '284258889', '925955527', 21, 'Apr', 2023, '2023-04-21 14:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `quizpackage`
--

CREATE TABLE `quizpackage` (
  `quizPackage_id` int(11) NOT NULL,
  `quizPackage_unique_id` varchar(250) NOT NULL,
  `quizPackage_name` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `upload_date` varchar(100) NOT NULL,
  `update_date` varchar(100) NOT NULL,
  `order_toshow_content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizpackage`
--

INSERT INTO `quizpackage` (`quizPackage_id`, `quizPackage_unique_id`, `quizPackage_name`, `course_id`, `upload_date`, `update_date`, `order_toshow_content`) VALUES
(40, '20230421168207680086Quiz 1', 'Quiz 1', 40, '2023-04-21 06:03:20', '2023-04-21 06:03:20', 0),
(41, '20230421168207755734 HTML Forms', ' HTML Forms', 41, '2023-04-21 06:15:57', '2023-04-21 06:15:57', 0),
(42, '20230421168208080591Quiz 1', 'Quiz 1', 42, '2023-04-21 07:10:05', '2023-04-21 07:10:05', 0),
(43, '20230421168208156740Quiz1 ', 'Quiz1 ', 43, '2023-04-21 07:22:47', '2023-04-21 07:22:47', 0),
(44, '20230421168208237894Quiz1', 'Quiz1', 44, '2023-04-21 07:36:18', '2023-04-21 07:36:18', 0),
(45, '20230421168208336415Quiz 1', 'Quiz 1', 45, '2023-04-21 07:52:44', '2023-04-21 07:52:44', 0),
(46, '20230421168208544915Quiz 1', 'Quiz 1', 46, '2023-04-21 08:27:29', '2023-04-21 08:27:29', 0),
(55, '20230422168213846548Quiz 1', 'Quiz 1', 51, '2023-04-22 11:11:05', '2023-04-22 11:11:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`, `category_id`, `status`) VALUES
(1, 'Web Development', 1, 'Active'),
(2, 'Data Science', 1, 'Active'),
(3, 'Mobile Development', 1, 'Active'),
(4, 'Programming Languages', 1, 'Active'),
(5, 'Entrepreneurship', 2, 'Active'),
(6, 'Communication', 2, 'Active'),
(8, 'Sales', 2, 'Active'),
(11, 'Management', 3, 'Active'),
(17, 'Accounting', 3, 'Active'),
(18, 'Cryptocurrency', 3, 'Active'),
(19, 'Economics', 3, 'Active'),
(20, 'Finance', 3, 'Active'),
(21, 'Network Security', 4, 'Active'),
(22, 'Hardware', 4, 'Active'),
(23, 'Operating Systems', 4, 'Active'),
(24, 'Microsoft', 5, 'Active'),
(25, 'Apple', 5, 'Active'),
(26, 'Google', 5, 'Active'),
(27, 'Oracle', 5, 'Active'),
(28, 'Personal Transformation', 6, 'Active'),
(29, 'Leadership', 6, 'Active'),
(30, 'Web Design', 7, 'Active'),
(31, 'Graphic Design', 7, 'Active'),
(32, 'Design Tools', 7, 'Active'),
(33, 'Digital Marketing', 8, 'Active'),
(34, 'Search Engine Optimization', 8, 'Active'),
(35, 'Branding', 8, 'Active'),
(36, 'Beauty Makeup', 9, 'Active'),
(37, 'Food & Beverage', 9, 'Active'),
(38, 'Photography Potrait', 10, 'Active'),
(39, 'Video Design', 10, 'Active'),
(40, 'Fitness', 11, 'Active'),
(41, 'Sports', 11, 'Active'),
(42, 'Yoga', 11, 'Active'),
(43, 'Instruments', 12, 'Active'),
(44, 'Vocal', 12, 'Active'),
(45, 'Music Software', 12, 'Active'),
(46, 'Network Security', 4, 'Active'),
(47, 'Hardware', 4, 'Active'),
(48, 'Operating Systems', 4, 'Active'),
(49, 'Microsoft', 5, 'Active'),
(50, 'Apple', 5, 'Active'),
(51, 'Google', 5, 'Active'),
(52, 'Oracle', 5, 'Active'),
(53, 'Personal Transformation', 6, 'Active'),
(54, 'Leadership', 6, 'Active'),
(55, 'Web Design', 7, 'Active'),
(56, 'Graphic Design', 7, 'Active'),
(57, 'Design Tools', 7, 'Active'),
(58, 'Digital Marketing', 8, 'Active'),
(59, 'Search Engine Optimization', 8, 'Active'),
(60, 'Branding', 8, 'Active'),
(61, 'Beauty Makeup', 9, 'Active'),
(62, 'Food & Beverage', 9, 'Active'),
(63, 'Photography Potrait', 10, 'Active'),
(64, 'Video Design', 10, 'Active'),
(71, 'Engineering', 13, 'Active'),
(72, 'Maths', 13, 'Active'),
(73, 'Science', 13, 'Active'),
(74, 'Online Education', 13, 'Active'),
(75, 'Engineering', 13, 'Active'),
(76, 'Maths', 13, 'Active'),
(77, 'Science', 13, 'Active'),
(78, 'Online Education', 13, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(200) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmPassword` varchar(255) NOT NULL,
  `image` varchar(400) NOT NULL DEFAULT 'assets/images/DefaultProfile.jpg',
  `status` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `job` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fullName`, `email`, `password`, `confirmPassword`, `image`, `status`, `about`, `job`, `contact_phone`, `contact_email`, `address`, `twitter`, `facebook`, `youtube`, `linkedin`) VALUES
(38, 1292484688, 'Josh Hordan', 'instructor@gmail.com', 'dbe417b0ac3038e78bb1952d04341840', 'dbe417b0ac3038e78bb1952d04341840', 'assets/files/2023042216821546701292484688.jpg', 'Offline now', '  I am a software engineer who has 5 years of senior level experience and currently working in the world leading software company. and more than 3 years experience in guiding of the software enginnering to the junior. ', 'Software engineer', '+956278292321312', 'JoshHordan@gmail.com', 'No 108, St.Mary Street, Yangon', '', '', '', ''),
(39, 1428740410, 'Daniel Johnson', 'instructor1@gmail.com', 'dbe417b0ac3038e78bb1952d04341840', 'dbe417b0ac3038e78bb1952d04341840', 'assets/images/DefaultProfile.jpg', 'Offline now', '', '', '', '', '', '', '', '', ''),
(40, 925955527, 'Olivia Davis', 'instructor2@gmail.com', 'dbe417b0ac3038e78bb1952d04341840', 'dbe417b0ac3038e78bb1952d04341840', 'assets/images/DefaultProfile.jpg', 'Offline now', '', '', '', '', '', '', '', '', ''),
(41, 1433005905, 'Ava Taylor', 'instructor3@gmail.com', 'dbe417b0ac3038e78bb1952d04341840', 'dbe417b0ac3038e78bb1952d04341840', 'assets/images/DefaultProfile.jpg', 'Offline now', '', '', '', '', '', '', '', '', ''),
(42, 284258889, 'Isabella Baker', 'instructor4@gmail.com', 'dbe417b0ac3038e78bb1952d04341840', 'dbe417b0ac3038e78bb1952d04341840', 'assets/files/202304211682085917284258889.jpg', 'Offline now', '', '', '', '', '', '', '', '', ''),
(44, 1068313003, 'Samantha Smith', 'user@gmail.com', 'dbe417b0ac3038e78bb1952d04341840', 'dbe417b0ac3038e78bb1952d04341840', 'assets/files/2023042216821842021068313003.jpg', 'Active now', 'I am a passionate junior web developer with a strong foundation in HTML, CSS, and JavaScript. I am always eager to learn new technologies and enhance her skills to create beautiful and functional websites.', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `certificate_completion`
--
ALTER TABLE `certificate_completion`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`,`course_unique_id`);

--
-- Indexes for table `coursecomplete`
--
ALTER TABLE `coursecomplete`
  ADD PRIMARY KEY (`complete_id`);

--
-- Indexes for table `coursequiz`
--
ALTER TABLE `coursequiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `coursevideo`
--
ALTER TABLE `coursevideo`
  ADD PRIMARY KEY (`video_id`,`video_unique_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `order_toshow_content`
--
ALTER TABLE `order_toshow_content`
  ADD PRIMARY KEY (`contentOrderID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchasedetail`
--
ALTER TABLE `purchasedetail`
  ADD PRIMARY KEY (`purchase_unique_id`,`course_id`);

--
-- Indexes for table `quizpackage`
--
ALTER TABLE `quizpackage`
  ADD PRIMARY KEY (`quizPackage_id`,`quizPackage_unique_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `certificate_completion`
--
ALTER TABLE `certificate_completion`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `coursecomplete`
--
ALTER TABLE `coursecomplete`
  MODIFY `complete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `coursequiz`
--
ALTER TABLE `coursequiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `coursevideo`
--
ALTER TABLE `coursevideo`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_toshow_content`
--
ALTER TABLE `order_toshow_content`
  MODIFY `contentOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `quizpackage`
--
ALTER TABLE `quizpackage`
  MODIFY `quizPackage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
