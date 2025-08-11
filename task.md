# структура для разработки

##  Форма заявки (готовая форма )
1. Ф.И.О. (на кириллице)  
2. Ф.И.О. (на латинице)  
3. Иностранный гражданин: да/нет  
4. По какому направлению желаете пройти курс (список направлений/категорий)  
5. Место работы и адрес: страна, город, категория (вуз/школа/колледж/другое)  
6. Ученая степень и занимаемая должность  
7. Специальность  
8. Преподаваемые предметы  
9. E-mail  
10. Мобильный телефон  
11. По какому курсу желаете повысить квалификацию (свободный ввод/выбор из перечня)  
12. Сроки прохождения семинара (две даты)  
13. Язык прохождения курса (казахский/русский/английский)  
14. Логин (если отдельно от e-mail)  
15. Пароль  

---

## Структура данных (БД/модели)

### 1. Аутентификация и учетные записи
**users**
- id (uuid, PK)
- email (citext, уникальный, обязательный)
- email_verified (boolean, default false)
- password_hash (text)
- created_at (timestamptz)
- updated_at (timestamptz)

**email_verifications**
- id (uuid, PK)
- user_id (uuid, FK → users.id)
- token (varchar(128), уникальный)
- expires_at (timestamptz)
- used_at (timestamptz, nullable)

### 2. Справочники
**faculties**
- id (uuid, PK)
- name_ru, name_kz, name_en
- sort_order (int)

**courses**
- id (uuid, PK)
- faculty_id (uuid, FK → faculties.id)
- name_ru, name_kz, name_en
- is_active (boolean)
- sort_order (int)

**specializations**
- id (uuid, PK)
- course_id (uuid, FK → courses.id)
- name_ru, name_kz, name_en
- is_active (boolean)
- sort_order (int)

**education_languages**
- code (varchar(8), PK) — ‘kk’, ‘ru’, ‘en’
- name_ru

### 3. Заявка (application)
**applications**
- id (uuid, PK)
- user_id (uuid, FK → users.id)
- full_name_cyr (varchar(255))
- full_name_lat (varchar(255))
- is_foreign_citizen (boolean)
- desired_track_id (uuid, FK → courses.id, nullable)
- employer_country (varchar(100))
- employer_city (varchar(100))
- employer_category (varchar(50)) — ENUM
- degree (varchar(150))
- position (varchar(150))
- specialty (varchar(200))
- taught_subjects (varchar(300))
- contact_email (citext)
- contact_phone (varchar(32))
- desired_course_text (varchar(300))
- specialization_id (uuid, FK → specializations.id, nullable)
- seminar_date_from (date)
- seminar_date_to (date)
- study_language (varchar(8), FK → education_languages.code)
- login (varchar(150), nullable)
- status (varchar(32)) — ENUM
- created_at (timestamptz)
- updated_at (timestamptz)

**application_files**
- id (uuid, PK)
- application_id (uuid, FK → applications.id)
- kind (varchar(32))
- file_url (text)
- uploaded_at (timestamptz)

---

## Черновик ORM (Django)

```python
class User(AbstractBaseUser, PermissionsMixin):
    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    email = CIEmailField(unique=True)
    email_verified = models.BooleanField(default=False)
    password = models.CharField(max_length=255)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

class EmailVerification(models.Model):
    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    token = models.CharField(max_length=128, unique=True)
    expires_at = models.DateTimeField()
    used_at = models.DateTimeField(null=True, blank=True)
```

```python
class Faculty(models.Model):
    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    name_ru = models.CharField(max_length=255)
    name_kz = models.CharField(max_length=255, blank=True)
    name_en = models.CharField(max_length=255, blank=True)
    sort_order = models.IntegerField(default=0)

class Course(models.Model):
    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    faculty = models.ForeignKey(Faculty, on_delete=models.CASCADE)
    name_ru = models.CharField(max_length=255)
    name_kz = models.CharField(max_length=255, blank=True)
    name_en = models.CharField(max_length=255, blank=True)
    is_active = models.BooleanField(default=True)
    sort_order = models.IntegerField(default=0)

class Specialization(models.Model):
    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    course = models.ForeignKey(Course, on_delete=models.CASCADE)
    name_ru = models.CharField(max_length=255)
    name_kz = models.CharField(max_length=255, blank=True)
    name_en = models.CharField(max_length=255, blank=True)
    is_active = models.BooleanField(default=True)
    sort_order = models.IntegerField(default=0)

class EducationLanguage(models.Model):
    code = models.CharField(primary_key=True, max_length=8)
    name_ru = models.CharField(max_length=64)
```

```python
class Application(models.Model):
    class EmployerCategory(models.TextChoices):
        VUZ = 'vuz', 'ВУЗ'
        SCHOOL = 'school', 'Школа'
        COLLEGE = 'college', 'Колледж'
        OTHER = 'other', 'Другое'

    class Status(models.TextChoices):
        DRAFT = 'draft', 'Черновик'
        SUBMITTED = 'submitted', 'Отправлена'
        IN_REVIEW = 'in_review', 'На рассмотрении'
        APPROVED = 'approved', 'Одобрена'
        REJECTED = 'rejected', 'Отклонена'

    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)
    user = models.ForeignKey(settings.AUTH_USER_MODEL, on_delete=models.PROTECT)
    full_name_cyr = models.CharField(max_length=255)
    full_name_lat = models.CharField(max_length=255)
    is_foreign_citizen = models.BooleanField()
    desired_track = models.ForeignKey(Course, null=True, blank=True, on_delete=models.SET_NULL)
    employer_country = models.CharField(max_length=100)
    employer_city = models.CharField(max_length=100)
    employer_category = models.CharField(max_length=10, choices=EmployerCategory.choices)
    degree = models.CharField(max_length=150, blank=True)
    position = models.CharField(max_length=150, blank=True)
    specialty = models.CharField(max_length=200, blank=True)
    taught_subjects = models.CharField(max_length=300, blank=True)
    contact_email = CIEmailField()
    contact_phone = models.CharField(max_length=32)
    desired_course_text = models.CharField(max_length=300, blank=True)
    specialization = models.ForeignKey(Specialization, null=True, blank=True, on_delete=models.SET_NULL)
    seminar_date_from = models.DateField()
    seminar_date_to = models.DateField()
    study_language = models.ForeignKey(EducationLanguage, to_field='code', on_delete=models.PROTECT)
    login = models.CharField(max_length=150, blank=True)
    status = models.CharField(max_length=20, choices=Status.choices, default=Status.DRAFT)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)
```


пример как будут сохранятся курсы типо связка 

# Приложение 1 — Полный перечень направлений и специализаций

## I. Биология
- Биология
- Ботаника
- Биохимия
- Инновационные методы обучения биологии
- Генетика
- Молекулярная биология
- Биофизика
- Хронобиология
- Вирусология
- Микробиология
- Зоология
- Ихтиология
- Гистология
- Цитология
- Почвоведение
- Экология
- Генетика и селекция растений
- Основы экологической генетики
- Молекулярная медицина и генетика
- Современные проблемы хронобиологии и хрономедицины
- Иммунология
- Психофизиология
- Современные проблемы биологии
- Экологическая физиология
- Актуальные проблемы биофизики
- Биотехнология

## II. География
- География
- Гидрология суши
- Геоморфология
- Метеорология
- Геоэкология и мониторинг природной среды
- Экономическая география
- Социальная география
- Физическая география
- Туризм
- Маркшейдерское дело
- Геомеханика
- Инновационные методы преподавания географии
- Геодезия
- Геоинформатика
- Картография
- Геофизика
- Технология - ГИС
- Современные геодезические инструменты
- Картографирование ГИС
- Анализ точности маркшейдерско-геодезических измерений
- Современные проблемы геодезии в области добычи урана
- Географические информационные системы дистанционного обучения и регионального управления
- Экскурсовод
- Туристические инструкторы
- Информационно-картографическая поддержка туризма
- ГИС в туризме
- ООПТ в экологическом туризме
- Sabre (компьютерные системы бронирования)
- Безопасность жизнедеятельности и защита окружающей среды
- Стандартизация, сертификация и метрология (по отраслям)
- Землеустройство
- Кадастр
- Регионоведение
- Краеведение

## III. Механика-Математика
- Прикладная математика
- Механика
- Информационные системы
- Информатика
- Геометрия
- Алгебра
- Математическая логика
- Функциональный анализ
- Теория вероятности
- Дифференциальные уравнения
- Математическая физика
- Математический анализ
- Высшая математика и методика обучения
- Теория управления
- Математическая кибернетика
- Вычислительная математика
- Математическое моделирование
- Компьютерные и вычислительные технологии
- Робототехника. Роботизация и применение элементов искусственного интеллекта в среднем образовании
- Элементы и устройства автоматизации
- Основы электротехники и электроники
- Вычислительная техника и программное обеспечение
- Использование современных педагогических и SMART-технологий в техническом и профессиональном образовании
- Инновационные методы преподавания математики
- Подготовка к ЕНТ по математике и эффективные методы нового формата образования
- Методы и эффективные способы решения сложных задач при подготовке учеников к ЕНТ

## IV. Физика
- Астрономия (каз/рус)
- Вакуумные методы осаждения различных покрытий (каз/рус/англ)
- Введение в Искусственный Интеллект (каз/рус/англ)
- Введение в науку и научное планирование (каз/рус)
- Введение в плазменную физику (каз/рус)
- Дополнительные главы квантовой механики (каз/рус)
- Инженерная и компьютерная графика (каз/рус)
- Инновационные методы преподавания физики (каз/рус)
- Компьютерное моделирование в физическом процессе (каз/рус/англ)
- Космическая техника и технология
- Криофизика и криотехнология (каз/рус)
- Математическое и компьютерное моделирование энергетических систем (каз/рус)
- Методы определения оптических характеристик веществ (каз/рус/англ)
- Методы синтеза и анализа наноматериалов (каз/рус/англ)
- Нанотехнология и наноматериалы (каз/рус/англ)
- Нетрадиционные и возобновляемые источники энергии (каз/рус/англ)
- Оптика (каз/рус)
- Основы вакуумного оборудования (каз/рус)
- Основы рентгеновской дифрактометрии: теория и практика (каз/рус/англ)
- Основы сетевой безопасности (каз/рус/англ)
- Основы сетевых технологий (Huawei) (каз/рус/англ)
- Плазменная электродинамика (каз/рус)
- Практический метод в ядерной физике (каз/рус)
- Применение ускорителей частиц в ядерной физике и исследованиях ядерной медицины (каз/рус)
- Принципы и методики атомно-силовой микроскопии (каз/рус/англ)
- Промышленная и силовая электроника (каз/рус)
- Промышленная электроника (каз/рус)
- Радиационная безопасность (каз/рус)
- Радиотехника, электроника и телекоммуникация (каз/рус)
- Раманская спектроскопия для междисциплинарных исследований (каз/рус/англ)
- Релейная защита и автоматика (каз/рус)
- Сканирующая электронная микроскопия (каз/рус/англ)
- Совершенствование педагогического мастерства учителей физики (каз/рус)
- Теоретическая физика (каз/рус/англ)
- Теплофизика (каз/рус)
- Техническая физика (каз/рус)
- Технологии беспроводной связи (каз/рус/англ)
- Улучшение интереса учеников к предмету через физические задачи (каз/рус)
- Физика газового разряда (каз/рус)
- Физика плазмы (каз/рус)
- Физика твердого тела (каз/рус)
- Электрические машины и электроприводы (каз/рус)
- Электричество и магнетизм (каз/рус)
- Электробезопасность (каз/рус)
- Электроника и нелинейные волновые процессы (каз/рус)
- Ядерная физика (каз/рус)

 
