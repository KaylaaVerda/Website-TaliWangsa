CREATE DATABASE IF NOT EXISTS taliwangsa;
USE taliwangsa;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    role ENUM('client','freelancer','admin') NOT NULL DEFAULT 'client',
    is_verified TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE freelancer_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    headline VARCHAR(255),
    bio TEXT,
    skills TEXT,
    hourly_rate DECIMAL(10,2) DEFAULT 0,
    availability TINYINT(1) DEFAULT 1,
    rating_avg DECIMAL(3,2) DEFAULT 0,
    total_reviews INT DEFAULT 0,
    total_orders INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) UNIQUE NOT NULL,
    icon VARCHAR(100),
    description TEXT,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    price_start DECIMAL(10,2) DEFAULT 0,
    price_end DECIMAL(10,2) DEFAULT 0,
    delivery_days INT DEFAULT 1,
    revision_count INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    total_orders INT DEFAULT 0,
    rating_avg DECIMAL(3,2) DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(100) UNIQUE NOT NULL,
    client_id INT NOT NULL,
    freelancer_id INT NOT NULL,
    service_id INT NOT NULL,
    title VARCHAR(255),
    description TEXT,
    price DECIMAL(10,2) DEFAULT 0,
    platform_fee DECIMAL(10,2) DEFAULT 0,
    freelancer_amount DECIMAL(10,2) DEFAULT 0,
    status ENUM(
        'unpaid',
        'paid',
        'in_progress',
        'delivered',
        'revision',
        'completed',
        'disputed',
        'cancelled'
    ) DEFAULT 'unpaid',
    deadline DATE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES users(id),
    FOREIGN KEY (freelancer_id) REFERENCES users(id),
    FOREIGN KEY (service_id) REFERENCES services(id)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    reviewer_id INT NOT NULL,
    reviewee_id INT NOT NULL,
    rating TINYINT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (reviewer_id) REFERENCES users(id),
    FOREIGN KEY (reviewee_id) REFERENCES users(id)
);

CREATE TABLE disputes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    raised_by INT NOT NULL,
    reason VARCHAR(255),
    description TEXT,
    status ENUM(
        'open',
        'under_review',
        'resolved_client',
        'resolved_freelancer',
        'cancelled'
    ) DEFAULT 'open',
    admin_note TEXT,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (raised_by) REFERENCES users(id)
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255),
    body TEXT,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255),
    answer TEXT,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0
);

INSERT INTO users 
(name,email,phone,password,avatar,role,is_verified)
VALUES
(
'Administrator',
'admin@taliwangsa.com',
'081111111111',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'admin.jpg',
'admin',
1
),

(
'Budi Santoso',
'budi@taliwangsa.com',
'081222222222',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'budi.jpg',
'freelancer',
1
),

(
'Siti Aulia',
'siti@taliwangsa.com',
'081333333333',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'siti.jpg',
'freelancer',
1
),

(
'Rizky Pratama',
'rizky@taliwangsa.com',
'081444444444',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'rizky.jpg',
'freelancer',
1
),

(
'Andi Wijaya',
'andi@taliwangsa.com',
'081555555555',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'andi.jpg',
'client',
1
),

(
'Dewi Lestari',
'dewi@taliwangsa.com',
'081666666666',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'dewi.jpg',
'client',
1
),

(
'Fajar Nugroho',
'fajar@taliwangsa.com',
'081777777777',
'$2y$10$wHh7bZKq9zYiujIIZeF1S.nQKxuxMxDPZWS9Vyuk3F7S3w7Dnk3aS',
'fajar.jpg',
'client',
1
);

INSERT INTO freelancer_profiles
(user_id,headline,bio,skills,hourly_rate,availability,rating_avg,total_reviews,total_orders)
VALUES
(
2,
'Graphic Designer Professional',
'Experienced graphic designer for branding and social media.',
'Photoshop, Illustrator, Figma',
15.00,
1,
4.9,
120,
80
),

(
3,
'Fullstack Web Developer',
'Building modern and scalable web applications.',
'PHP, CodeIgniter, Laravel, MySQL',
25.00,
1,
4.8,
98,
70
),

(
4,
'Video Editor & Motion Designer',
'Professional editor for reels and commercials.',
'Premiere Pro, After Effects',
20.00,
1,
4.7,
76,
55
);

INSERT INTO categories
(name,slug,icon,description,is_active,sort_order)
VALUES
('Desain Grafis','desain-grafis','palette','Graphic design services',1,1),
('Pengembangan Web','pengembangan-web','code','Website development',1,2),
('Pengembangan Aplikasi','pengembangan-aplikasi','smartphone','App development',1,3),
('Penulisan & Konten','penulisan-konten','pen','Writing services',1,4),
('Pemasaran Digital','pemasaran-digital','megaphone','Digital marketing',1,5),
('Video & Animasi','video-animasi','video','Animation and editing',1,6),
('Fotografi','fotografi','camera','Photography services',1,7),
('Bisnis & Konsultasi','bisnis-konsultasi','briefcase','Business consulting',1,8),
('Data & Analitik','data-analitik','database','Data analysis',1,9),
('Audio & Musik','audio-musik','music','Music production',1,10),
('Terjemahan','terjemahan','languages','Translation services',1,11),
('Pengelolaan Media Sosial','media-sosial','instagram','Social media management',1,12);

INSERT INTO services
(user_id,category_id,title,slug,description,price_start,price_end,delivery_days,revision_count,is_active,total_orders,rating_avg)
VALUES
(2,1,'Logo Design Professional','logo-design-professional','Professional logo design service',50,150,3,3,1,40,4.9),
(2,1,'Instagram Feed Design','instagram-feed-design','Creative social media feed',30,100,2,2,1,25,4.8),
(3,2,'Company Website Development','company-website-development','Responsive company profile website',300,1000,14,3,1,35,4.9),
(3,3,'Mobile App Development','mobile-app-development','Android application development',500,2000,21,2,1,20,4.8),
(4,6,'Professional Video Editing','professional-video-editing','Video editing for reels and ads',100,400,5,2,1,30,4.7),
(4,6,'Motion Graphics Animation','motion-graphics-animation','2D motion graphics animation',150,500,7,2,1,18,4.6);

INSERT INTO faqs
(question,answer,is_active,sort_order)
VALUES
('Apa itu TaliWangsa?','TaliWangsa adalah marketplace jasa profesional.',1,1),
('Bagaimana cara memesan jasa?','Pilih layanan lalu lakukan pembayaran.',1,2),
('Apakah pembayaran aman?','Semua pembayaran menggunakan sistem escrow.',1,3),
('Bagaimana menjadi freelancer?','Daftar akun lalu lengkapi profil freelancer.',1,4),
('Berapa biaya platform?','Platform mengambil biaya layanan tertentu.',1,5),
('Apakah bisa revisi pekerjaan?','Ya sesuai jumlah revisi layanan.',1,6),
('Bagaimana sistem dispute?','Anda dapat membuka dispute melalui dashboard.',1,7),
('Apakah akun harus diverifikasi?','Verifikasi membantu meningkatkan keamanan.',1,8),
('Metode pembayaran apa saja?','Transfer bank dan e-wallet tersedia.',1,9),
('Bagaimana menghubungi support?','Hubungi tim support melalui halaman kontak.',1,10);