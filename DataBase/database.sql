create or replace database cgbooker;

use cgbooker;

create table account
(   email varchar(50) not null primary key,
    password varchar(20) not null
);


create table room
( room_Num int unsigned not null primary key,
  location varchar(200),
  province varchar(2),
  type varchar(50),
  capacity varchar(10)
);

create table segment
( segment_Id int unsigned not null primary key,
  segment_Description varchar(15)
);

create table registration
( reg_Id int unsigned not null auto_increment primary key,
  room_Num int NOT NULL,
  segment_Id int NOT NULL,
  client_Id int NOT NULL,
  day date,
  status varchar(10),
  note varchar(250)
);



create table client
( client_Id int unsigned not null auto_increment primary key,
  last_Name varchar(50),
  first_Name varchar(50),
  email varchar(50),
  phone varchar(15),
  sport varchar(50),	
  province varchar(2),	
  coachOrAthlete int	/* 1 for coach, 0 for athlete  */
);

create table service
( service_Id int unsigned not null primary key,
  description varchar(250),
  type char(30)
);

create table service_Order
( ord_Id int unsigned not null auto_increment primary key,
  client_Id int NOT NULL,
  service_Id int NOT NULL,
  day date,
  shift varchar(11),
  checkin_Time varchar(15),
  status varchar(11),
  note varchar(250)
);

create table staff_Schedule
( item_Id int unsigned NOT NULL auto_increment primary key, 
  day date NOT NULL,
  shift varchar(11) NOT NULL,	/*9:00-13:00; 13:00-16:00; 17:00-22:00 */
  employee_Num int,
  service_position varchar(30),	/*location or physicion, nursePractioner, rMassage, Physiotherapist, chripractor, rNurse, ptOrAt, reception, Mental Health Check, Doctor Assessment for volunteer */
  ord_Id int,
  item_Status varchar(11),
  note varchar(250)
);

create table Staff
( employee_Num int unsigned NOT NULL auto_increment primary key,
  last_Name varchar(50),
  first_Name varchar(50),
  specialty varchar(50),	/* Admin, volunteer */
  email varchar(50),
  phone varchar(15),
  note varchar(250)
);

insert into account
values
  ('shengqi2016@gmail.com', '19970208'),
  ('admin@admin.com', 'admin'),
  ('ca.sa@wg.ca', 'casa'),
  ('cb.sb@wg.ca', 'cbsb'),
  ('cc.sc@wg.ca', 'ccsc'),
  ('ad.sd@wg.ca', 'adsd'),
  ('ae.se@wg.ca', 'aese'),
  ('af.sf@wg.ca', 'afsf'),
  ('vg.sg@wg.ca', 'vgsg'),
  ('vh.sh@wg.ca', 'vhsh'),
  ('vi.si@wg.ca', 'visi'),
  ('vj.sj@wg.ca', 'vjsj'),
  ('vk.sk@wg.ca', 'vksk'),
  ('vl.sl@wg.ca', 'vlsl'),
  ('vm.sm@wg.ca', 'vmsm'),
  ('vn.sn@wg.ca', 'vnsn'),
  ('vo.so@wg.ca', 'voso');


insert into room 
values
  (1, 'McDougall Hall 242', 'ON', 'Lecture Theatre / Salle de conférence', '199ppl'),
  (2, 'McDougall Hall 243', 'BC', 'Lecture Theatre / Salle de conférence', '80ppl'),
  (3, 'McDougall Hall 329', 'AB', 'Classroom / Salle de classe', '60ppl'),
  (4, 'McDougall Hall 215', 'MB', 'Classroom / Salle de classe', '50ppl'),
  (5, 'McDougall Hall 246', 'QC', 'Lecture Theatre / Salle de conférence', '60ppl'),
  (6, 'McDougall Hall 328', 'SK', 'Classroom / Salle de classe', '60ppl'),
  (7, 'McDougall Hall 231', 'NT', 'Classroom / Salle de classe', '25ppl'),
  (8, 'KC Irving 104', 'NB', 'Lecture Theatre / Salle de conférence', '75ppl'),
  (9, 'FSDE 205', 'NS', 'Classroom / Salle de classe', '40ppl'),
  (10, 'FSDE 202', 'NL', 'Classroom / Salle de classe', '40ppl'),
  (11, 'FSDE 301', 'YK', 'Lab / Laboratoire', '30ppl'),
  (12, 'FSDE 212', 'NU', 'Classroom / Salle de classe', '25ppl'),
  (13, 'FSDE 306', 'PE', 'Classroom / Salle de classe', '25ppl');


insert into segment (segment_Id, segment_Description)
values
  (1, '8:00-9:00'),
  (2, '9:00-10:00'),
  (3, '10:00-11:00'),
  (4, '11:00-12:00'),
  (5, '12:00-13:00'),
  (6, '13:00-14:00'),
  (7, '14:00-15:00'),
  (8, '15:00-16:00'),
  (9, '16:00-17:00'),
  (10, '17:00-18:00'),
  (11, '18:00-19:00'),
  (12, '19:00-20:00'),
  (13, '20:00-21:00');

insert into service
values
  (1, 'Mental Health Check description', 'Mental Health Check'),
  (2, "Doctor's Assessment description", "Doctor's Assessment"),
  (3, "Physician", "Physician"),
  (4, "Nurse Practioner", "Nurse Practioner"),
  (5, "R Massage", "R Massage"),
  (6, "Physiotherapist", "Physiotherapist"),
  (7, "Chripractor", "Chripractor"),
  (8, "R Nurse", "R Nurse"),
  (9, "PT or AT", "PT or AT"),
  (10, "Reception", "Reception");
/* physicion, nursePractioner, rMassage, Physiotherapist, chripractor, rNurse, ptOrAt, reception, Mental Health Check, Doctor Assessment for volunteer */

insert into client
values
  (NULL, 'CoathA', 'SurA', 'ca.sa@wg.ca', NULL, 'Snowboarding', 'PE', 1),
  (NULL, 'CoathB', 'SurB', 'cb.sb@wg.ca', NULL, 'Snowboarding', 'ON', 1),
  (NULL, 'CoathC', 'SurC', 'cc.sc@wg.ca', NULL, 'Snowboarding', 'NS', 1),
  (NULL, 'AthleteD', 'SurD', 'ad.sd@wg.ca', NULL, 'Snowboarding', 'PE', 0),
  (NULL, 'AthleteE', 'SurE', 'ae.se@wg.ca', NULL, 'Snowboarding', 'ON', 0),
  (NULL, 'AthleteF', 'SurF', 'af.sf@wg.ca', NULL, 'Snowboarding', 'NS', 0);

insert into staff
values
  (NULL, 'Admin', 'Admin', 'Admin', 'admin@admin.com', NULL, NULL),
  (NULL, 'VolunteerG', 'SurG', 'Mental Health Check', 'vg.sg@wg.ca', NULL, NULL),
  (NULL, 'VolunteerH', 'SurH', 'Mental Health Check', 'vh.sh@wg.ca', NULL, NULL),
  (NULL, 'VolunteerI', 'SurI', 'Mental Health Check', 'vi.si@wg.ca', NULL, NULL),
  (NULL, 'VolunteerJ', 'SurJ', 'R Massage', 'vj.sj@wg.ca', NULL, NULL),
  (NULL, 'VolunteerK', 'SurK', 'R Massage', 'vk.sk@wg.ca', NULL, NULL),
  (NULL, 'VolunteerL', 'SurL', 'R Massage', 'vl.sl@wg.ca', NULL, NULL),
  (NULL, "VolunteerM", "SurM", "Doctor's Assessment", "vm.sm@wg.ca", NULL, NULL),
  (NULL, "VolunteerN", "SurN", "Doctor's Assessment", "vn.sn@wg.ca", NULL, NULL),
  (NULL, "VolunteerO", "SurO", "Doctor's Assessment", "vo.so@wg.ca", NULL, NULL);



insert into registration
values
  (NULL, 13, 2, 1, '2022-02-18', 'ordered', NULL),
  (NULL, 13, 1, 1, '2022-02-19', 'ordered', NULL),
  (NULL, 1, 10, 2, '2022-02-20', 'ordered', NULL),
  (NULL, 1, 8, 2, '2022-02-21', 'ordered', NULL),
  (NULL, 1, 5, 2, '2022-02-22', 'ordered', NULL),
  (NULL, 9, 2, 3, '2022-02-19', 'ordered', NULL),
  (NULL, 9, 11, 3, '2022-02-19', 'ordered', NULL);

insert into service_order
values
  (NULL, 4, 1, '2023-02-18', '9:00-13:00', '9:00 am', 'ordered', NULL),
  (NULL, 4, 10, '2023-02-20', '9:00-13:00', '9:00 am', 'ordered', NULL),
  (NULL, 4, 2, '2023-02-19', '9:00-13:00', '12:00 pm', 'ordered', NULL),
  (NULL, 4, 1, '2023-02-20', '13:00-16:00', '14:00 pm', 'ordered', NULL),
  (NULL, 4, 1, '2023-02-21', '9:00-13:00', '9:00 am', 'ordered', NULL),
  (NULL, 4, 10, '2023-02-22', '9:00-13:00', '9:00 am', 'ordered', NULL),
  (NULL, 4, 2, '2023-02-23', '9:00-13:00', '12:00 pm', 'confirmed', NULL),
  (NULL, 4, 1, '2023-02-24', '13:00-16:00', '14:00 pm', 'ordered', NULL);

insert into staff_schedule
values
  (NULL, '2023-02-23', '9:00-13:00', 9, "location", 7, 'confirmed', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 2, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '9:00-13:00', 2, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '9:00-13:00', 2, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 2, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 2, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 3, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '13:00-16:00', 3, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '13:00-16:00', 3, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 3, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 3, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 4, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '9:00-13:00', 4, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '9:00-13:00', 4, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 4, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 4, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 5, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '13:00-16:00', 5, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '13:00-16:00', 5, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 5, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 5, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 6, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '9:00-13:00', 6, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '9:00-13:00', 6, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 6, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 6, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 7, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '13:00-16:00', 7, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '13:00-16:00', 7, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 7, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 7, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 8, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '9:00-13:00', 8, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '9:00-13:00', 8, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 8, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 8, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 9, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '13:00-16:00', 9, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '13:00-16:00', 9, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '9:00-13:00', 9, "location", NULL, 'available', NULL),
  (NULL, '2023-02-24', '9:00-13:00', 9, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '9:00-13:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-18', '13:00-16:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '9:00-13:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-19', '17:00-22:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '9:00-13:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-20', '13:00-16:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-21', '13:00-16:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-21', '17:00-22:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '13:00-16:00', 10, "location", NULL, 'available', NULL),
  (NULL, '2023-02-22', '17:00-22:00', 10, "location", NULL, 'available', NULL);
  