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

create table cac_nhan_su(
	ma_nhan_su int primary key auto_increment,
    ten_cong_trinh varchar(250),
    nam_cong_bo date,
    tap_chi varchar(250),
	ma_thong_tin_ca_nhan int,
	FOREIGN KEY (ma_thong_tin_ca_nhan) REFERENCES thong_tin_ca_nhan(ma_thong_tin_ca_nhan)
);

create table lanh_dao_truong(
	ma_lanh_dao_truong int primary key auto_increment,    
    phong_ban varchar(20),
    thanh_tich varchar(100),
    danh_gia varchar(100),
	kiem_duyet boolean,
    ma_thong_tin_ca_nhan int,
	FOREIGN KEY (ma_thong_tin_ca_nhan) REFERENCES thong_tin_ca_nhan(ma_thong_tin_ca_nhan)
);

create table lanh_dao_don_vi(
	ma_lanh_dao_don_vi int primary key auto_increment,
    thanh_tich varchar(100),
    danh_gia varchar(100),
	ma_thong_tin_ca_nhan int,
	FOREIGN KEY (ma_thong_tin_ca_nhan) REFERENCES thong_tin_ca_nhan(ma_thong_tin_ca_nhan)
);
