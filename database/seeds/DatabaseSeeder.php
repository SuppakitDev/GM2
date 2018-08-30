<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('tbddcstatusdescript')->insert(array(
            array('INVModel'=>'M250TH','Status'=>0,'Descript'=>'Stop'),
            array('INVModel'=>'M250TH','Status'=>1,'Descript'=>'Oprating'),
         ));

        DB::table('tbddc_tempctrldescript')->insert(array(
            array('INVModel'=>'M250TH','TempCtrl'=>0,'Descript'=>'OFF'),
            array('INVModel'=>'M250TH','TempCtrl'=>1,'Descript'=>'ON'),
         ));

        DB::table('tbddc_vctrldescript')->insert(array(
            array('INVModel'=>'M250TH','VCtrl'=>0,'Descript'=>'Voltage Constant'),
            array('INVModel'=>'M250TH','VCtrl'=>1,'Descript'=>'MPPT'),
         ));

        DB::table('tberrordescript')->insert(array(
            array('INVModel'=>'M250TH','ErrorCode'=>'000','Descript'=>''),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx2','Descript'=>'Input over voltage'),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx3','Descript'=>'DC relay'),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx4','Descript'=>'Overheating'),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx5','Descript'=>'Themistor abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx6','Descript'=>'Input over current'),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx8','Descript'=>'Arc self check'),
            array('INVModel'=>'M250TH','ErrorCode'=>'Dx9','Descript'=>'Arc abnormal'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E01','Descript'=>'DC over voltage software'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E02','Descript'=>'DC under voltage'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E03','Descript'=>'IPM abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E05','Descript'=>'DC midpoint voltage abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E06','Descript'=>'Leakage current 1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E07','Descript'=>'Leakage current 2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E08','Descript'=>'Leakage current 3'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E09','Descript'=>'Leakage current 4'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E10','Descript'=>'Leakage current self-check'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E11','Descript'=>'Insulation resistance decreased self check'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E12','Descript'=>'Insulation resistance decreases'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E13','Descript'=>'Insulation resistance decreases 4 times'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E21','Descript'=>'RDY signal abnormal'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E22','Descript'=>'ISO 5V abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E24','Descript'=>'DC over voltage hardware'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E25','Descript'=>'Fan lock abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E41','Descript'=>'Remote stop'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E61','Descript'=>'DC/DC under voltage'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E86','Descript'=>'MBX-PCS communication error'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E90','Descript'=>'EEPROM communication error'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E91','Descript'=>'IPM temperature anomaly'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E92','Descript'=>'Temperature decrease'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E93','Descript'=>'EEPROM checksum abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E94','Descript'=>'Inverter thermistor abnormality'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E95','Descript'=>'Other abnormal (auto return) 1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E96','Descript'=>'Other abnormal (auto return) 2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E97','Descript'=>'Other abnormal (auto return) 3'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E98','Descript'=>'Other abnormal (manual return) 1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'E99','Descript'=>'Other abnormal (manual return) 2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G01','Descript'=>'Over voltage LV.1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G02','Descript'=>'Under voltage LV.1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G03','Descript'=>'Over frequency LV.1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G04','Descript'=>'Under frequency LV.1'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G05','Descript'=>'Stand alone operation (passive)'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G06','Descript'=>'Stand alone operation (active)'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G08','Descript'=>'Instant over voltage'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G10','Descript'=>'DC Component leakage'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G11','Descript'=>'Instantaneous over current software'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G13','Descript'=>'Phase order abnomal'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G20','Descript'=>'Over voltage LV.2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G21','Descript'=>'Over voltage LV.3'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G22','Descript'=>'Under voltage LV.2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G23','Descript'=>'Under voltage LV.3'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G24','Descript'=>'Over frequency LV.2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G25','Descript'=>'Under frequency LV.2'),
            array('INVModel'=>'M250TH','ErrorCode'=>'G26','Descript'=>'Instantaneous over current hardware'),
            array('INVModel'=>'M250TH','ErrorCode'=>'M01','Descript'=>'Master box RTC communication error'),
            array('INVModel'=>'M250TH','ErrorCode'=>'M02','Descript'=>'Master box RTC data error'),
            array('INVModel'=>'M250TH','ErrorCode'=>'M03','Descript'=>'Master box EEPROM communication error'),
            array('INVModel'=>'M250TH','ErrorCode'=>'M04','Descript'=>'Master box EEPROM CheckSum data abnormal'),
            array('INVModel'=>'M250TH','ErrorCode'=>'M05','Descript'=>'Master box I2C access error'),
            array('INVModel'=>'M250TH','ErrorCode'=>'ZZZ','Descript'=>'No error'),
        ));

        DB::table('tbpcsstatusdescript')->insert(array(
            array('INVModel'=>'M250TH','Status'=>0,'Descript'=>'Stop'),
            array('INVModel'=>'M250TH','Status'=>1,'Descript'=>'Preparing'),
            array('INVModel'=>'M250TH','Status'=>2,'Descript'=>'Operating'),
            array('INVModel'=>'M250TH','Status'=>3,'Descript'=>'Error'),
        ));

        DB::table('tbsuppressiondescript')->insert(array(
            array('INVModel'=>'M250TH','SupressionStatus'=>0,'Descript'=>'OFF'),
            array('INVModel'=>'M250TH','SupressionStatus'=>1,'Descript'=>'ON'),
        ));

        DB::table('model_type')->insert(array(
            array('Model_t'=>'A001','Descript'=>'Z50-MPT'),
            array('Model_t'=>'Z001','Descript'=>'Z50-30ST2'),
            array('Model_t'=>'Z002','Descript'=>'Z50-55ST3'),
         ));

         DB::table('reg_mode')->insert(array(
            array('Reg_mode'=>'C','Descript'=>'CHINA'),
            array('Reg_mode'=>'M','Descript'=>'MEA'),
            array('Reg_mode'=>'P','Descript'=>'PEA'),
         ));

         DB::table('error_code')->insert(array(
            array('Errorcode'=>'T','Descript'=>'Error code about temperature.'),
            array('Errorcode'=>'N','Descript'=>'Error code about communication.'),
            array('Errorcode'=>'G','Descript'=>'Error code about grid system.'),
            array('Errorcode'=>'E','Descript'=>'Total error code.'),
            array('Errorcode'=>'D','Descript'=>'Error code about DDC.'),
         ));

         DB::table('insp_test_mode')->insert(array(
            array('Insp_test'=>'0','Descript'=>'Normal operate'),
            array('Insp_test'=>'A','Descript'=>'Testing number 0'),
            array('Insp_test'=>'B','Descript'=>'Testing number 1'),
            array('Insp_test'=>'C','Descript'=>'Testing number 2'),
            array('Insp_test'=>'D','Descript'=>'Testing number 3'),
            array('Insp_test'=>'E','Descript'=>'Testing number 4'),
            array('Insp_test'=>'F','Descript'=>'Testing number 5'),
            array('Insp_test'=>'G','Descript'=>'Testing number 6'),
            array('Insp_test'=>'H','Descript'=>'Testing number 7'),
            array('Insp_test'=>'I','Descript'=>'Testing number 8'),         
            array('Insp_test'=>'J','Descript'=>'Testing number 9'),         
         ));

         DB::table('sts_pcs')->insert(array(
            array('Pcs_status'=>'A','Descript'=>'Grid connection in preparation.'),
            array('Pcs_status'=>'B','Descript'=>'Grid connection in operation'),
            array('Pcs_status'=>'C','Descript'=>'Grid connection in manual stop'),
            array('Pcs_status'=>'D','Descript'=>'Stand alone in preparation.'),
            array('Pcs_status'=>'E','Descript'=>'Stand alone in operation.'),
            array('Pcs_status'=>'F','Descript'=>'Stand alone in manual stop.'),
            array('Pcs_status'=>'G','Descript'=>'Failure or into systems error.'),
            array('Pcs_status'=>'H','Descript'=>'Setting value.'),
            array('Pcs_status'=>'I','Descript'=>'Reservation.'),         
            array('Pcs_status'=>'J','Descript'=>'Reservation.'),         
         ));

         DB::table('sts_rt_pf')->insert(array(
            array('Statuspowerfactor'=>'d','Descript'=>'Disable status after power conditioner stop.'),
            array('Statuspowerfactor'=>'e','Descript'=>'Enable status after power conditioner operates.'),
         ));
    }
}
