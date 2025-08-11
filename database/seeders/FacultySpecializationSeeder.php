<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FacultySpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Отключаем FK (MySQL)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Очищаем таблицы перед заполнением
        DB::table('specializations')->truncate();
        DB::table('faculties')->truncate();
        DB::table('education_languages')->truncate();
        
        // Включаем FK назад
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Заполняем факультеты согласно task.md
        $faculties = [
            ['name_ru' => 'Биология', 'name_en' => 'Biology', 'name_kz' => 'Биология'],
            ['name_ru' => 'География', 'name_en' => 'Geography', 'name_kz' => 'География'],
            ['name_ru' => 'Механика-Математика', 'name_en' => 'Mechanics-Mathematics', 'name_kz' => 'Механика-Математика'],
            ['name_ru' => 'Физика', 'name_en' => 'Physics', 'name_kz' => 'Физика'],
        ];

        foreach ($faculties as $index => $faculty) {
            DB::table('faculties')->insert([
                'id' => Str::uuid(),
                'name_ru' => $faculty['name_ru'],
                'name_en' => $faculty['name_en'],
                'name_kz' => $faculty['name_kz'],
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Получаем ID факультетов для связи
        $facultyIds = DB::table('faculties')->pluck('id')->toArray();

        // Заполняем специализации по факультетам согласно task.md
        $specializations = [
            // Биология (факультет 1)
            ['faculty_index' => 0, 'name_ru' => 'Биология', 'name_en' => 'Biology', 'name_kz' => 'Биология'],
            ['faculty_index' => 0, 'name_ru' => 'Ботаника', 'name_en' => 'Botany', 'name_kz' => 'Ботаника'],
            ['faculty_index' => 0, 'name_ru' => 'Биохимия', 'name_en' => 'Biochemistry', 'name_kz' => 'Биохимия'],
            ['faculty_index' => 0, 'name_ru' => 'Инновационные методы обучения биологии', 'name_en' => 'Innovative Methods of Teaching Biology', 'name_kz' => 'Биологияны оқытудың инновациялық әдістері'],
            ['faculty_index' => 0, 'name_ru' => 'Генетика', 'name_en' => 'Genetics', 'name_kz' => 'Генетика'],
            ['faculty_index' => 0, 'name_ru' => 'Молекулярная биология', 'name_en' => 'Molecular Biology', 'name_kz' => 'Молекулалық биология'],
            ['faculty_index' => 0, 'name_ru' => 'Биофизика', 'name_en' => 'Biophysics', 'name_kz' => 'Биофизика'],
            ['faculty_index' => 0, 'name_ru' => 'Хронобиология', 'name_en' => 'Chronobiology', 'name_kz' => 'Хронобиология'],
            ['faculty_index' => 0, 'name_ru' => 'Вирусология', 'name_en' => 'Virology', 'name_kz' => 'Вирусология'],
            ['faculty_index' => 0, 'name_ru' => 'Микробиология', 'name_en' => 'Microbiology', 'name_kz' => 'Микробиология'],
            ['faculty_index' => 0, 'name_ru' => 'Зоология', 'name_en' => 'Zoology', 'name_kz' => 'Зоология'],
            ['faculty_index' => 0, 'name_ru' => 'Ихтиология', 'name_en' => 'Ichthyology', 'name_kz' => 'Ихтиология'],
            ['faculty_index' => 0, 'name_ru' => 'Гистология', 'name_en' => 'Histology', 'name_kz' => 'Гистология'],
            ['faculty_index' => 0, 'name_ru' => 'Цитология', 'name_en' => 'Cytology', 'name_kz' => 'Цитология'],
            ['faculty_index' => 0, 'name_ru' => 'Почвоведение', 'name_en' => 'Soil Science', 'name_kz' => 'Топырақтану'],
            ['faculty_index' => 0, 'name_ru' => 'Экология', 'name_en' => 'Ecology', 'name_kz' => 'Экология'],
            ['faculty_index' => 0, 'name_ru' => 'Генетика и селекция растений', 'name_en' => 'Plant Genetics and Breeding', 'name_kz' => 'Өсімдіктер генетикасы және селекциясы'],
            ['faculty_index' => 0, 'name_ru' => 'Основы экологической генетики', 'name_en' => 'Fundamentals of Ecological Genetics', 'name_kz' => 'Экологиялық генетиканың негіздері'],
            ['faculty_index' => 0, 'name_ru' => 'Молекулярная медицина и генетика', 'name_en' => 'Molecular Medicine and Genetics', 'name_kz' => 'Молекулалық медицина және генетика'],
            ['faculty_index' => 0, 'name_ru' => 'Современные проблемы хронобиологии и хрономедицины', 'name_en' => 'Modern Problems of Chronobiology and Chronomedicine', 'name_kz' => 'Хронобиология және хрономедицинаның қазіргі мәселелері'],
            ['faculty_index' => 0, 'name_ru' => 'Иммунология', 'name_en' => 'Immunology', 'name_kz' => 'Иммунология'],
            ['faculty_index' => 0, 'name_ru' => 'Психофизиология', 'name_en' => 'Psychophysiology', 'name_kz' => 'Психофизиология'],
            ['faculty_index' => 0, 'name_ru' => 'Современные проблемы биологии', 'name_en' => 'Modern Problems of Biology', 'name_kz' => 'Биологияның қазіргі мәселелері'],
            ['faculty_index' => 0, 'name_ru' => 'Экологическая физиология', 'name_en' => 'Ecological Physiology', 'name_kz' => 'Экологиялық физиология'],
            ['faculty_index' => 0, 'name_ru' => 'Актуальные проблемы биофизики', 'name_en' => 'Current Problems of Biophysics', 'name_kz' => 'Биофизиканың өзекті мәселелері'],
            ['faculty_index' => 0, 'name_ru' => 'Биотехнология', 'name_en' => 'Biotechnology', 'name_kz' => 'Биотехнология'],

            // География (факультет 2)
            ['faculty_index' => 1, 'name_ru' => 'География', 'name_en' => 'Geography', 'name_kz' => 'География'],
            ['faculty_index' => 1, 'name_ru' => 'Гидрология суши', 'name_en' => 'Land Hydrology', 'name_kz' => 'Құрлық гидрологиясы'],
            ['faculty_index' => 1, 'name_ru' => 'Геоморфология', 'name_en' => 'Geomorphology', 'name_kz' => 'Геоморфология'],
            ['faculty_index' => 1, 'name_ru' => 'Метеорология', 'name_en' => 'Meteorology', 'name_kz' => 'Метеорология'],
            ['faculty_index' => 1, 'name_ru' => 'Геоэкология и мониторинг природной среды', 'name_en' => 'Geoecology and Environmental Monitoring', 'name_kz' => 'Геоэкология және табиғи ортаны бақылау'],
            ['faculty_index' => 1, 'name_ru' => 'Экономическая география', 'name_en' => 'Economic Geography', 'name_kz' => 'Экономикалық география'],
            ['faculty_index' => 1, 'name_ru' => 'Социальная география', 'name_en' => 'Social Geography', 'name_kz' => 'Әлеуметтік география'],
            ['faculty_index' => 1, 'name_ru' => 'Физическая география', 'name_en' => 'Physical Geography', 'name_kz' => 'Физикалық география'],
            ['faculty_index' => 1, 'name_ru' => 'Туризм', 'name_en' => 'Tourism', 'name_kz' => 'Туризм'],
            ['faculty_index' => 1, 'name_ru' => 'Маркшейдерское дело', 'name_en' => 'Mine Surveying', 'name_kz' => 'Маркшейдерлік іс'],
            ['faculty_index' => 1, 'name_ru' => 'Геомеханика', 'name_en' => 'Geomechanics', 'name_kz' => 'Геомеханика'],
            ['faculty_index' => 1, 'name_ru' => 'Инновационные методы преподавания географии', 'name_en' => 'Innovative Methods of Teaching Geography', 'name_kz' => 'Географияны оқытудың инновациялық әдістері'],
            ['faculty_index' => 1, 'name_ru' => 'Геодезия', 'name_en' => 'Geodesy', 'name_kz' => 'Геодезия'],
            ['faculty_index' => 1, 'name_ru' => 'Геоинформатика', 'name_en' => 'Geoinformatics', 'name_kz' => 'Геоинформатика'],
            ['faculty_index' => 1, 'name_ru' => 'Картография', 'name_en' => 'Cartography', 'name_kz' => 'Картография'],
            ['faculty_index' => 1, 'name_ru' => 'Геофизика', 'name_en' => 'Geophysics', 'name_kz' => 'Геофизика'],
            ['faculty_index' => 1, 'name_ru' => 'Технология - ГИС', 'name_en' => 'GIS Technology', 'name_kz' => 'ГИС технологиясы'],
            ['faculty_index' => 1, 'name_ru' => 'Современные геодезические инструменты', 'name_en' => 'Modern Geodetic Instruments', 'name_kz' => 'Қазіргі геодезиялық құралдар'],
            ['faculty_index' => 1, 'name_ru' => 'Картографирование ГИС', 'name_en' => 'GIS Mapping', 'name_kz' => 'ГИС картографиясы'],
            ['faculty_index' => 1, 'name_ru' => 'Анализ точности маркшейдерско-геодезических измерений', 'name_en' => 'Analysis of Accuracy of Mine Surveying and Geodetic Measurements', 'name_kz' => 'Маркшейдерлік-геодезиялық өлшемдердің дәлдігін талдау'],
            ['faculty_index' => 1, 'name_ru' => 'Современные проблемы геодезии в области добычи урана', 'name_en' => 'Modern Problems of Geodesy in Uranium Mining', 'name_kz' => 'Уран өндіру саласындағы геодезияның қазіргі мәселелері'],
            ['faculty_index' => 1, 'name_ru' => 'Географические информационные системы дистанционного обучения и регионального управления', 'name_en' => 'Geographic Information Systems for Distance Learning and Regional Management', 'name_kz' => 'Қашықтықтан оқыту және аймақтық басқарудың географиялық ақпараттық жүйелері'],
            ['faculty_index' => 1, 'name_ru' => 'Экскурсовод', 'name_en' => 'Tour Guide', 'name_kz' => 'Экскурсия жолбасшысы'],
            ['faculty_index' => 1, 'name_ru' => 'Туристические инструкторы', 'name_en' => 'Tourist Instructors', 'name_kz' => 'Туристік нұсқаушылар'],
            ['faculty_index' => 1, 'name_ru' => 'Информационно-картографическая поддержка туризма', 'name_en' => 'Information and Cartographic Support for Tourism', 'name_kz' => 'Туризмнің ақпараттық-картографиялық қолдауы'],
            ['faculty_index' => 1, 'name_ru' => 'ГИС в туризме', 'name_en' => 'GIS in Tourism', 'name_kz' => 'Туризмдегі ГИС'],
            ['faculty_index' => 1, 'name_ru' => 'ООПТ в экологическом туризме', 'name_en' => 'Protected Areas in Ecotourism', 'name_kz' => 'Экологиялық туризмдегі ТҚО'],
            ['faculty_index' => 1, 'name_ru' => 'Sabre (компьютерные системы бронирования)', 'name_en' => 'Sabre (Computer Reservation Systems)', 'name_kz' => 'Sabre (брондау компьютерлік жүйелері)'],
            ['faculty_index' => 1, 'name_ru' => 'Безопасность жизнедеятельности и защита окружающей среды', 'name_en' => 'Life Safety and Environmental Protection', 'name_kz' => 'Өмір сүру қауіпсіздігі және қоршаған ортаны қорғау'],
            ['faculty_index' => 1, 'name_ru' => 'Стандартизация, сертификация и метрология (по отраслям)', 'name_en' => 'Standardization, Certification and Metrology (by Industry)', 'name_kz' => 'Стандарттау, сертификация және метрология (салалар бойынша)'],
            ['faculty_index' => 1, 'name_ru' => 'Землеустройство', 'name_en' => 'Land Management', 'name_kz' => 'Жерге орналастыру'],
            ['faculty_index' => 1, 'name_ru' => 'Кадастр', 'name_en' => 'Cadastre', 'name_kz' => 'Кадастр'],
            ['faculty_index' => 1, 'name_ru' => 'Регионоведение', 'name_en' => 'Regional Studies', 'name_kz' => 'Аймақтану'],
            ['faculty_index' => 1, 'name_ru' => 'Краеведение', 'name_en' => 'Local History', 'name_kz' => 'Өлкетану'],

            // Механика-Математика (факультет 3)
            ['faculty_index' => 2, 'name_ru' => 'Прикладная математика', 'name_en' => 'Applied Mathematics', 'name_kz' => 'Қолданыстық математика'],
            ['faculty_index' => 2, 'name_ru' => 'Механика', 'name_en' => 'Mechanics', 'name_kz' => 'Механика'],
            ['faculty_index' => 2, 'name_ru' => 'Информационные системы', 'name_en' => 'Information Systems', 'name_kz' => 'Ақпараттық жүйелер'],
            ['faculty_index' => 2, 'name_ru' => 'Информатика', 'name_en' => 'Informatics', 'name_kz' => 'Информатика'],
            ['faculty_index' => 2, 'name_ru' => 'Геометрия', 'name_en' => 'Geometry', 'name_kz' => 'Геометрия'],
            ['faculty_index' => 2, 'name_ru' => 'Алгебра', 'name_en' => 'Algebra', 'name_kz' => 'Алгебра'],
            ['faculty_index' => 2, 'name_ru' => 'Математическая логика', 'name_en' => 'Mathematical Logic', 'name_kz' => 'Математикалық логика'],
            ['faculty_index' => 2, 'name_ru' => 'Функциональный анализ', 'name_en' => 'Functional Analysis', 'name_kz' => 'Функционалдық талдау'],
            ['faculty_index' => 2, 'name_ru' => 'Теория вероятности', 'name_en' => 'Probability Theory', 'name_kz' => 'Ықтималдық теориясы'],
            ['faculty_index' => 2, 'name_ru' => 'Дифференциальные уравнения', 'name_en' => 'Differential Equations', 'name_kz' => 'Дифференциалдық теңдеулер'],
            ['faculty_index' => 2, 'name_ru' => 'Математическая физика', 'name_en' => 'Mathematical Physics', 'name_kz' => 'Математикалық физика'],
            ['faculty_index' => 2, 'name_ru' => 'Математический анализ', 'name_en' => 'Mathematical Analysis', 'name_kz' => 'Математикалық талдау'],
            ['faculty_index' => 2, 'name_ru' => 'Высшая математика и методика обучения', 'name_en' => 'Higher Mathematics and Teaching Methods', 'name_kz' => 'Жоғары математика және оқыту әдістемесі'],
            ['faculty_index' => 2, 'name_ru' => 'Теория управления', 'name_en' => 'Control Theory', 'name_kz' => 'Басқару теориясы'],
            ['faculty_index' => 2, 'name_ru' => 'Математическая кибернетика', 'name_en' => 'Mathematical Cybernetics', 'name_kz' => 'Математикалық кибернетика'],
            ['faculty_index' => 2, 'name_ru' => 'Вычислительная математика', 'name_en' => 'Computational Mathematics', 'name_kz' => 'Есептеу математикасы'],
            ['faculty_index' => 2, 'name_ru' => 'Математическое моделирование', 'name_en' => 'Mathematical Modeling', 'name_kz' => 'Математикалық модельдеу'],
            ['faculty_index' => 2, 'name_ru' => 'Компьютерные и вычислительные технологии', 'name_en' => 'Computer and Computational Technologies', 'name_kz' => 'Компьютерлік және есептеу технологиялары'],
            ['faculty_index' => 2, 'name_ru' => 'Робототехника. Роботизация и применение элементов искусственного интеллекта в среднем образовании', 'name_en' => 'Robotics. Robotization and Application of Artificial Intelligence Elements in Secondary Education', 'name_kz' => 'Робототехника. Роботтандыру және орта білімде жасанды интеллект элементтерін қолдану'],
            ['faculty_index' => 2, 'name_ru' => 'Элементы и устройства автоматизации', 'name_en' => 'Elements and Automation Devices', 'name_kz' => 'Автоматтандыру элементтері мен құрылғылары'],
            ['faculty_index' => 2, 'name_ru' => 'Основы электротехники и электроники', 'name_en' => 'Fundamentals of Electrical Engineering and Electronics', 'name_kz' => 'Электротехника мен электрониканың негіздері'],
            ['faculty_index' => 2, 'name_ru' => 'Вычислительная техника и программное обеспечение', 'name_en' => 'Computer Technology and Software', 'name_kz' => 'Есептеу техникасы және бағдарламалық қамтамасыз ету'],
            ['faculty_index' => 2, 'name_ru' => 'Использование современных педагогических и SMART-технологий в техническом и профессиональном образовании', 'name_en' => 'Use of Modern Pedagogical and SMART Technologies in Technical and Vocational Education', 'name_kz' => 'Техникалық және кәсіби білімде қазіргі педагогикалық және SMART-технологияларды қолдану'],
            ['faculty_index' => 2, 'name_ru' => 'Инновационные методы преподавания математики', 'name_en' => 'Innovative Methods of Teaching Mathematics', 'name_kz' => 'Математиканы оқытудың инновациялық әдістері'],
            ['faculty_index' => 2, 'name_ru' => 'Подготовка к ЕНТ по математике и эффективные методы нового формата образования', 'name_en' => 'Preparation for UNT in Mathematics and Effective Methods of New Education Format', 'name_kz' => 'Математика бойынша БТЖ-ға дайындық және білім берудің жаңа форматының тиімді әдістері'],
            ['faculty_index' => 2, 'name_ru' => 'Методы и эффективные способы решения сложных задач при подготовке учеников к ЕНТ', 'name_en' => 'Methods and Effective Ways of Solving Complex Problems in Preparing Students for UNT', 'name_kz' => 'Оқушыларды БТЖ-ға дайындау кезінде күрделі есептерді шешудің әдістері мен тиімді тәсілдері'],

            // Физика (факультет 4)
            ['faculty_index' => 3, 'name_ru' => 'Астрономия (каз/рус)', 'name_en' => 'Astronomy (Kaz/Rus)', 'name_kz' => 'Астрономия (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Вакуумные методы осаждения различных покрытий (каз/рус/англ)', 'name_en' => 'Vacuum Methods of Deposition of Various Coatings (Kaz/Rus/Eng)', 'name_kz' => 'Әртүрлі жабындарды шөгіндірудің вакуумдық әдістері (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Введение в Искусственный Интеллект (каз/рус/англ)', 'name_en' => 'Introduction to Artificial Intelligence (Kaz/Rus/Eng)', 'name_kz' => 'Жасанды Интеллектке кіріспе (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Введение в науку и научное планирование (каз/рус)', 'name_en' => 'Introduction to Science and Scientific Planning (Kaz/Rus)', 'name_kz' => 'Ғылымға және ғылыми жоспарлауға кіріспе (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Введение в плазменную физику (каз/рус)', 'name_en' => 'Introduction to Plasma Physics (Kaz/Rus)', 'name_kz' => 'Плазма физикасына кіріспе (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Дополнительные главы квантовой механики (каз/рус)', 'name_en' => 'Additional Chapters of Quantum Mechanics (Kaz/Rus)', 'name_kz' => 'Кванттық механиканың қосымша тараулары (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Инженерная и компьютерная графика (каз/рус)', 'name_en' => 'Engineering and Computer Graphics (Kaz/Rus)', 'name_kz' => 'Инженерлік және компьютерлік графика (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Инновационные методы преподавания физики (каз/рус)', 'name_en' => 'Innovative Methods of Teaching Physics (Kaz/Rus)', 'name_kz' => 'Физиканы оқытудың инновациялық әдістері (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Компьютерное моделирование в физическом процессе (каз/рус/англ)', 'name_en' => 'Computer Modeling in Physical Process (Kaz/Rus/Eng)', 'name_kz' => 'Физикалық процесте компьютерлік модельдеу (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Космическая техника и технология', 'name_en' => 'Space Technology and Technology', 'name_kz' => 'Ғарыштық техника және технология'],
            ['faculty_index' => 3, 'name_ru' => 'Криофизика и криотехнология (каз/рус)', 'name_en' => 'Cryophysics and Cryotechnology (Kaz/Rus)', 'name_kz' => 'Криофизика және криотехнология (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Математическое и компьютерное моделирование энергетических систем (каз/рус)', 'name_en' => 'Mathematical and Computer Modeling of Energy Systems (Kaz/Rus)', 'name_kz' => 'Энергетикалық жүйелердің математикалық және компьютерлік модельдеуі (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Методы определения оптических характеристик веществ (каз/рус/англ)', 'name_en' => 'Methods for Determining Optical Characteristics of Substances (Kaz/Rus/Eng)', 'name_kz' => 'Заттардың оптикалық сипаттамаларын анықтау әдістері (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Методы синтеза и анализа наноматериалов (каз/рус/англ)', 'name_en' => 'Methods of Synthesis and Analysis of Nanomaterials (Kaz/Rus/Eng)', 'name_kz' => 'Наноматериалдарды синтездеу және талдау әдістері (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Нанотехнология и наноматериалы (каз/рус/англ)', 'name_en' => 'Nanotechnology and Nanomaterials (Kaz/Rus/Eng)', 'name_kz' => 'Нанотехнология және наноматериалдар (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Нетрадиционные и возобновляемые источники энергии (каз/рус/англ)', 'name_en' => 'Non-traditional and Renewable Energy Sources (Kaz/Rus/Eng)', 'name_kz' => 'Дәстүрлі емес және қайталанмалы энергия көздері (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Оптика (каз/рус)', 'name_en' => 'Optics (Kaz/Rus)', 'name_kz' => 'Оптика (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Основы вакуумного оборудования (каз/рус)', 'name_en' => 'Fundamentals of Vacuum Equipment (Kaz/Rus)', 'name_kz' => 'Вакуумдық жабдықтардың негіздері (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Основы рентгеновской дифрактометрии: теория и практика (каз/рус/англ)', 'name_en' => 'Fundamentals of X-ray Diffractometry: Theory and Practice (Kaz/Rus/Eng)', 'name_kz' => 'Рентген сәулелерінің дифрактометриясының негіздері: теория және тәжірибе (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Основы сетевой безопасности (каз/рус/англ)', 'name_en' => 'Fundamentals of Network Security (Kaz/Rus/Eng)', 'name_kz' => 'Желі қауіпсіздігінің негіздері (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Основы сетевых технологий (Huawei) (каз/рус/англ)', 'name_en' => 'Fundamentals of Network Technologies (Huawei) (Kaz/Rus/Eng)', 'name_kz' => 'Желі технологияларының негіздері (Huawei) (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Плазменная электродинамика (каз/рус)', 'name_en' => 'Plasma Electrodynamics (Kaz/Rus)', 'name_kz' => 'Плазма электродинамикасы (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Практический метод в ядерной физике (каз/рус)', 'name_en' => 'Practical Method in Nuclear Physics (Kaz/Rus)', 'name_kz' => 'Ядролық физикадағы практикалық әдіс (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Применение ускорителей частиц в ядерной физике и исследованиях ядерной медицины (каз/рус)', 'name_en' => 'Application of Particle Accelerators in Nuclear Physics and Nuclear Medicine Research (Kaz/Rus)', 'name_kz' => 'Бөлшектерді жеделдеткіштерді ядролық физикада және ядролық медицина зерттеулерінде қолдану (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Принципы и методики атомно-силовой микроскопии (каз/рус/англ)', 'name_en' => 'Principles and Methods of Atomic Force Microscopy (Kaz/Rus/Eng)', 'name_kz' => 'Атомдық күш микроскопиясының принциптері мен әдістері (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Промышленная и силовая электроника (каз/рус)', 'name_en' => 'Industrial and Power Electronics (Kaz/Rus)', 'name_kz' => 'Өнеркәсіптік және қуатты электроника (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Промышленная электроника (каз/рус)', 'name_en' => 'Industrial Electronics (Kaz/Rus)', 'name_kz' => 'Өнеркәсіптік электроника (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Радиационная безопасность (каз/рус)', 'name_en' => 'Radiation Safety (Kaz/Rus)', 'name_kz' => 'Сәулелену қауіпсіздігі (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Радиотехника, электроника и телекоммуникация (каз/рус)', 'name_en' => 'Radio Engineering, Electronics and Telecommunications (Kaz/Rus)', 'name_kz' => 'Радиотехника, электроника және телекоммуникация (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Раманская спектроскопия для междисциплинарных исследований (каз/рус/англ)', 'name_en' => 'Raman Spectroscopy for Interdisciplinary Research (Kaz/Rus/Eng)', 'name_kz' => 'Парасалды зерттеулер үшін Раман спектроскопиясы (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Релейная защита и автоматика (каз/рус)', 'name_en' => 'Relay Protection and Automation (Kaz/Rus)', 'name_kz' => 'Релелік қорғау және автоматтандыру (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Сканирующая электронная микроскопия (каз/рус/англ)', 'name_en' => 'Scanning Electron Microscopy (Kaz/Rus/Eng)', 'name_kz' => 'Сканерлеу электронды микроскопиясы (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Совершенствование педагогического мастерства учителей физики (каз/рус)', 'name_en' => 'Improving the Pedagogical Skills of Physics Teachers (Kaz/Rus)', 'name_kz' => 'Физика мұғалімдерінің педагогикалық шеберлігін жетілдіру (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Теоретическая физика (каз/рус/англ)', 'name_en' => 'Theoretical Physics (Kaz/Rus/Eng)', 'name_kz' => 'Теориялық физика (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Теплофизика (каз/рус)', 'name_en' => 'Thermophysics (Kaz/Rus)', 'name_kz' => 'Жылуфизика (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Техническая физика (каз/рус)', 'name_en' => 'Technical Physics (Kaz/Rus)', 'name_kz' => 'Техникалық физика (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Технологии беспроводной связи (каз/рус/англ)', 'name_en' => 'Wireless Communication Technologies (Kaz/Rus/Eng)', 'name_kz' => 'Сымсыз байланыс технологиялары (каз/рус/англ)'],
            ['faculty_index' => 3, 'name_ru' => 'Улучшение интереса учеников к предмету через физические задачи (каз/рус)', 'name_en' => 'Improving Students Interest in the Subject Through Physics Problems (Kaz/Rus)', 'name_kz' => 'Физикалық есептер арқылы оқушылардың пәнге деген қызығушылығын арттыру (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Физика газового разряда (каз/рус)', 'name_en' => 'Gas Discharge Physics (Kaz/Rus)', 'name_kz' => 'Газдық разряд физикасы (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Физика плазмы (каз/рус)', 'name_en' => 'Plasma Physics (Kaz/Rus)', 'name_kz' => 'Плазма физикасы (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Физика твердого тела (каз/рус)', 'name_en' => 'Solid State Physics (Kaz/Rus)', 'name_kz' => 'Қатты дене физикасы (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Электрические машины и электроприводы (каз/рус)', 'name_en' => 'Electrical Machines and Electric Drives (Kaz/Rus)', 'name_kz' => 'Электр машиналары және электроприводтар (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Электричество и магнетизм (каз/рус)', 'name_en' => 'Electricity and Magnetism (Kaz/Rus)', 'name_kz' => 'Электр және магниттілік (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Электробезопасность (каз/рус)', 'name_en' => 'Electrical Safety (Kaz/Rus)', 'name_kz' => 'Электр қауіпсіздігі (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Электроника и нелинейные волновые процессы (каз/рус)', 'name_en' => 'Electronics and Nonlinear Wave Processes (Kaz/Rus)', 'name_kz' => 'Электроника және сызықты емес толқынды процестер (каз/рус)'],
            ['faculty_index' => 3, 'name_ru' => 'Ядерная физика (каз/рус)', 'name_en' => 'Nuclear Physics (Kaz/Rus)', 'name_kz' => 'Ядролық физика (каз/рус)'],
        ];

        foreach ($specializations as $index => $specialization) {
            DB::table('specializations')->insert([
                'id' => Str::uuid(),
                'faculty_id' => $facultyIds[$specialization['faculty_index']], // Привязываем к соответствующему факультету
                'name_ru' => $specialization['name_ru'],
                'name_en' => $specialization['name_en'],
                'name_kz' => $specialization['name_kz'],
                'is_active' => 1,
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Заполняем языки образования
        $educationLanguages = [
            ['code' => 'ru', 'name_ru' => 'Русский'],
            ['code' => 'kk', 'name_ru' => 'Казахский'],
            ['code' => 'en', 'name_ru' => 'Английский'],
            ['code' => 'de', 'name_ru' => 'Немецкий'],
            ['code' => 'fr', 'name_ru' => 'Французский'],
            ['code' => 'es', 'name_ru' => 'Испанский'],
            ['code' => 'zh', 'name_ru' => 'Китайский'],
            ['code' => 'ar', 'name_ru' => 'Арабский'],
        ];

        foreach ($educationLanguages as $language) {
            DB::table('education_languages')->insert([
                'code' => $language['code'],
                'name_ru' => $language['name_ru'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Факультеты, специализации и языки образования успешно заполнены!');
    }
}
