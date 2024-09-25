-- Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình (2 đ)
SELECT *
FROM baiviet
WHERE ma_tloai = 2;

-- Liệt kê các bài viết của tác giả “Nhacvietplus” (2 đ)
SELECT bv.*
FROM baiviet bv
JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
WHERE tg.ten_tgia = 'Nhacvietplus';

--  Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào
SELECT tl.*
FROM theloai tl
LEFT JOIN baiviet bv ON tl.ma_tloai = bv.ma_tloai
WHERE bv.ma_bviet IS NULL;

-- Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết
SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tg.ten_tgia, tl.ten_tloai, bv.ngayviet
FROM baiviet bv
JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai;

-- Tìm thể loại có số bài viết nhiều nhất
SELECT tl.ma_tloai, tl.ten_tloai, COUNT(bv.ma_bviet) AS so_bai_viet
FROM theloai tl
LEFT JOIN baiviet bv ON tl.ma_tloai = bv.ma_tloai
GROUP BY tl.ma_tloai
ORDER BY so_bai_viet DESC
LIMIT 1;

-- Liệt kê 2 tác giả có số bài viết nhiều nhất (2 đ
SELECT tg.ma_tgia, tg.ten_tgia, COUNT(bv.ma_bviet) AS so_bai_viet
FROM tacgia tg
LEFT JOIN baiviet bv ON tg.ma_tgia = bv.ma_tgia
GROUP BY tg.ma_tgia
ORDER BY so_bai_viet DESC
LIMIT 2;


-- Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em” 

SELECT *
FROM baiviet
WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%';


--  Tạo 1 view có tên vw_Music để hiển thị thông tin về danh sách các bài viết kèm theo tên thể loại và tên tác giả

CREATE VIEW vw_Music AS
SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tg.ten_tgia, tl.ten_tloai, bv.ngayviet
FROM baiviet bv
JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai;


-- Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là tên thể loại và trả về danh sách bài viết của thể loại đó (2 đ)

DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN ten_the_loai VARCHAR(50))
BEGIN
    IF NOT EXISTS (SELECT * FROM theloai WHERE ten_tloai = ten_the_loai) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Thể loại không tồn tại';
    ELSE
        SELECT bv.*
        FROM baiviet bv
        JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai
        WHERE tl.ten_tloai = ten_the_loai;
    END IF;
END //

DELIMITER ;

-- Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo (2 đ)

ALTER TABLE theloai ADD SLBaiViet INT DEFAULT 0;

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai SET SLBaiViet = SLBaiViet + 1 WHERE ma_tloai = NEW.ma_tloai;
END;

CREATE TRIGGER tg_CapNhatTheLoai_Delete
AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai SET SLBaiViet = SLBaiViet - 1 WHERE ma_tloai = OLD.ma_tloai;
END;

-- Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web (5 đ)

CREATE TABLE Users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

