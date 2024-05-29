create database QLHSNS;
use QLHSNS;

-- drop database qlhsns;

create table thong_tin_ca_nhan (
	ma_thong_tin_ca_nhan int primary key auto_increment,
    ho_ten varchar(45),
    ngay_sinh date,
    gioi_tinh boolean,
    dia_chi varchar(100),
    phone varchar(20),
    email varchar(100),
    vi_tri_cong_viec varchar(50),
    don_vi_lam_viec varchar(50),
    muc_luong varchar(50),
    ngay_bat_dau_lam_viec date,
    thong_tin_bang_cap_kinh_nghiem varchar(250),
    username varchar(25),
    `password` varchar(50)
);
INSERT INTO thong_tin_ca_nhan (ho_ten, ngay_sinh, gioi_tinh, dia_chi, phone, email, vi_tri_cong_viec, don_vi_lam_viec, muc_luong, ngay_bat_dau_lam_viec, thong_tin_bang_cap_kinh_nghiem, username, password) VALUES
('Phương Văn Chí', '2003-05-15', 1, 'Bac Giang', '0912345678', 'Chi@example.com', 'giam doc', 'FBU', '1500 USD', '2021-09-01', 'Tien Si', 'phuongchi', 'password1'),
('Nguyễn Như Đông', '2003-08-20', 1, 'Ha Noi', '0987654321', 'Dong@example.com', 'giam doc', 'FBU', '1500 USD', '2021-08-15', 'Tien Si', 'nhudong', 'password2'),
('Bùi Thị Vi', '2003-11-30', 0, 'Hai Phong', '0922334455', 'Vi@example.com', 'lao cong', 'FBU', '50 USD', '2022-06-10', 'Thac Si', 'buivi', 'password3'),
('Hoàng Quốc Việt', '2003-03-25', 1, 'Hung Yen', '0933445566', 'Viet@example.com', 'giam doc', 'FBU', '1500 USD', '2021-01-20', 'Thac Si ', 'quocviet', 'password4');

create table cac_nhan_su(
	ma_nhan_su int primary key auto_increment,
    ten_cong_trinh varchar(250),
    nam_cong_bo int,
    tap_chi varchar(250),
	ma_thong_tin_ca_nhan int ,
	FOREIGN KEY (ma_thong_tin_ca_nhan) REFERENCES thong_tin_ca_nhan(ma_thong_tin_ca_nhan)
);
INSERT INTO cac_nhan_su (ten_cong_trinh, nam_cong_bo, tap_chi, ma_thong_tin_ca_nhan)
VALUES
('Nghien cuu ve kinh te Viet Nam', '2019', 'Tap chi Kinh te', 1),
('Quan ly tai nguyen nhan luc', '2020', 'Tap chi Quan ly', 2),
('Phat trien phan mem he thong', '2021', 'Tap chi Cong nghe thong tin', 3),
('Nghien cuu phat trien', '2022', 'Tap chi Cong nghe ',4),
('Nghien cuu ve kinh te Chau A', '2019', 'Tap chi Kinh te', 1),
('Quan ly tai nguyen khoang san', '2020', 'Tap chi Kinh Doanh', 2),
('Phat trien phan mem he thong AI', '2021', 'Tap chi Cong nghe thong tin', 3),
('Nghien cuu phat trien AI', '2022', 'Tap chi Cong nghe AI',4);


create table lanh_dao_truong(
	ma_lanh_dao_truong int primary key auto_increment,    
    phong_ban varchar(100),
    thanh_tich varchar(100),
    danh_gia varchar(100),
	kiem_duyet boolean,
    ma_thong_tin_ca_nhan int,
	FOREIGN KEY (ma_thong_tin_ca_nhan) REFERENCES thong_tin_ca_nhan(ma_thong_tin_ca_nhan)
);
INSERT INTO lanh_dao_truong (phong_ban, thanh_tich, danh_gia, kiem_duyet, ma_thong_tin_ca_nhan) VALUES
('Phong Kinh te', 'Giam doc xuat sac nam 2020', 'A', 1, 1),
('Phong Quan ly nhan su', 'Quan ly nhan su tot nhat nam 2019', 'B', 1, 2),
('Phong Phat trien phan mem', 'Du an thanh cong nam 2021', 'A', 1, 3);


create table lanh_dao_don_vi(
	ma_lanh_dao_don_vi int primary key auto_increment,
    thanh_tich varchar(100),
    danh_gia varchar(100),
	ma_thong_tin_ca_nhan int,
	FOREIGN KEY (ma_thong_tin_ca_nhan) REFERENCES thong_tin_ca_nhan(ma_thong_tin_ca_nhan)
);

INSERT INTO lanh_dao_don_vi (thanh_tich, danh_gia, ma_thong_tin_ca_nhan)
VALUES
('Nhan vien xuat sac nam 2021', 'A', 3),
('Nhan vien tieu bieu nam 2020', 'B', 2),
('Nhan vien sang tao nam 2019', 'A', 1);
