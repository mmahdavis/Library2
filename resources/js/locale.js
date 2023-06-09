import { createI18n } from 'vue-i18n';

const i18n = createI18n({
    locale: localStorage.getItem("language") ?? 'en',
    fallbackLocale: 'en',
    legacy: false,
    messages: {
        en: {
            appTopBar: {
                siteName: 'Library Admin',
                calendar: 'Calendar',
                profile: 'Profile',
                language: 'Language',
            },
            Messages: {
                Required: {
                    Name: 'Name is required.',
                    InventoryStatus: 'Inventory Status is required.',
                    Price: 'Price is required.',
                    Quantity: 'Quantity is required.',
                },
                Confirm: {
                    Delete: (ctx) => `Are you sure you want to delete ${ctx.named('name')}?`,
                    DeleteBooks: 'Are you sure you want to delete the selected Books?',
                    DeleteWriters: 'Are you sure you want to delete the selected Writers?',
                    DeletePublishers: 'Are you sure you want to delete the selected Publishers?',
                    DeleteTranslators: 'Are you sure you want to delete the selected Translators?',
                    DeleteCategories: 'Are you sure you want to delete the selected Categories?',
                    DeleteTags: 'Are you sure you want to delete the selected Tags?',
                },
                Toast: {
                    Success:{
                        BookDelete: 'Book Deleted Successfuly.',
                        BooksDelete: 'Books Deleted Successfuly.',
                        BookCreated: 'Book Created Successfuly',
                        WriterDelete: 'Writer Deleted Successfuly.',
                        WritersDelete: 'Writers Deleted Successfuly.',
                        WriterCreated: 'Writer Created Successfuly',
                        PublisherDelete: 'Publisher Deleted Successfuly.',
                        PublishersDelete: 'Publishers Deleted Successfuly.',
                        PublisherCreated: 'Publisher Created Successfuly',
                        TranslatorDelete: 'Translator Deleted Successfuly.',
                        TranslatorsDelete: 'Translators Deleted Successfuly.',
                        TranslatorCreated: 'Translator Created Successfuly',
                        magazineDelete: 'magazine Deleted Successfuly.',
                        magazinesDelete: 'magazines Deleted Successfuly.',
                        magazineCreated: 'magazine Created Successfuly',
                        SpecialIssueDelete: 'Special Issue Deleted Successfuly.',
                        SpecialIssuesDelete: 'Special Issues Deleted Successfuly.',
                        SpecialIssueCreated: 'Special Issue Created Successfuly',
                    },
                    Faild: {

                    },
                },
            },
            Select: {
                Category: 'Select Category',
                Tags: 'Select Tags',
                Writer: 'Select Writer',
                Publisher: 'Select Publisher',
                Translator: 'Select Translator',
                Status: 'Select Status',
            },
            Login:{
                Header: 'Welcome',
                Message: 'Please Sign in to continue',
            },
            Register:{
                Header: 'Welcome',
                Message: 'Please Sign up to continue',
            },
            Placeholder: {
                Name: 'Enter Name',
                Email: 'Enter Email Address',
                Password: 'Enter Your Password',
                ConfirmPassword: 'Confirm Password',
            },

            AlreadyRegistered: 'Already Registered?',
            Email: 'Email',
            Password: 'Password',
            ConfirmPassword: 'Confirm Password',
            RememberMe: 'Remember me',
            ForgotPassword: 'Forgot Password?',
            SignIn: 'Sign In',
            SignUp: 'Sign Un',
            SignOut: 'Sign Out',
            NewMember: 'New Member',
            Dashboard: 'Dashboard',
            Books: 'Books',
            Book: 'Book',
            Writers: 'Writers',
            Writer: 'Writer',
            Publishers: 'Publishers',
            Publisher: 'Publisher',
            Translators: 'Translators',
            Translator: 'Translator',
            Magazines: 'Magazines',
            Special_Issues: 'Special Issues',
            Images: 'Images',
            Audios: 'Audios',
            PDFs: 'PDFs',
            New: 'New',
            Delete: 'Delete',
            Export: 'Export',
            Manage: 'Manage',
            Search: 'Search',
            Code: 'Code',
            Name: 'Name',
            Image: 'Image',
            Price: 'Price',
            Category: 'Category',
            Reviews: 'Reviews',
            Status: 'Status',
            Slug: 'Slug',
            Details: 'Details',
            Add: 'Add',
            Edit: 'Edit',
            BookImage: 'Book Image',
            WriterImage: 'Writer Image',
            PublisherImage: 'Publisher Image',
            TranslatorImage: 'Translator Image',
            MagazineImage: 'Magazine Image',
            SpecialIssueImage: 'Special Issue Image',
            InventoryStatus: 'Inventory Status',
            Quantity: 'Quantity',
            Tags: 'Tags',
            Confirm: 'Confirm',
            Yes: 'Yes',
            No: 'No',
            Cancel: 'Cancel',
            Save: 'Save',
            For: 'for',
        },
        fa: {
            appTopBar: {
                siteName: 'پنل ادمین',
                calendar: 'تقویم',
                profile: 'پروفایل',
                language: 'زبان',
            },
            Messages: {
                Required: {
                    Name: 'نام اجباری است.',
                    InventoryStatus: 'فیلد وضعیت انبار اجباری است.',
                    Price: 'قیمت اجباری است.',
                    Quantity: 'موجودی اجباری است.',
                },
                Confirm: {
                    Delete: (ctx) => `آیا از حذف ${ctx.named('name')} مطمئن هستید؟`,
                    DeleteBooks: 'آیا از حذف کتاب ها مطمئن هستید؟',
                    DeleteWriters: 'آیا از حذف نویسندگان مطمئن هستید؟',
                    DeletePublishers: 'آیا از حذف ناشران مطمئن هستید؟',
                    DeleteTranslators: 'آیا از حذف مترجمان مطمئن هستید؟',
                    DeleteCategories: 'آیا از حذف دسته بندی ها مطمئن هستید؟',
                    DeleteTags: 'آیا از حذف کلید واژه ها مطمئن هستید؟',
                },
                Toast: {
                    Success:{
                        BookDelete: 'کتاب با موفقیت حذف شد.',
                        BooksDelete: 'کتاب ها با موفقیت حذف شدند.',
                        BookCreated: 'کتاب با موفقیت ساخته شد.',
                        WriterDelete: 'نویسنده با موفقیت حذف شد.',
                        WritersDelete: 'نویسندگان با موفقیت حذف شدند.',
                        WriterCreated: 'نویسنده با موفقیت ساخته شد.',
                        PublisherDelete: 'ناشر با موفقیت حذف شد.',
                        PublishersDelete: 'ناشران با موفقیت حذف شدند.',
                        PublisherCreated: 'ناشر با موفقیت ساخته شد.',
                        TranslatorDelete: 'مترجم با موفقیت حذف شد.',
                        TranslatorsDelete: 'مترجم ها با موفقیت حذف شدند.',
                        TranslatorCreated: 'مترجم با موفقیت ساخته شد.',
                        magazineDelete: 'مجله با موفقیت حذف شد.',
                        magazinesDelete: 'مجلات با موفقیت حذف شدند.',
                        magazineCreated: 'مجله با موفقیت ساخته شد.',
                        SpecialIssueDelete: 'ویژه نامه با موفقیت حذف شد.',
                        SpecialIssuesDelete: 'ویژه نامه ها با موفقیت حذف شدند.',
                        SpecialIssueCreated: 'ویژه نامه با موفقیت ساخته شد.',
                    },
                    Faild: {

                    },
                },
            },
            Select: {
                Category: 'انتخاب دسته بندی',
                Tags: ' انتخاب برچسب ها',
                Writer: 'انتخاب نویسنده',
                Publisher: 'انتخاب ناشر',
                Translator: 'انتخاب مترجم',
                Status: 'انتخاب وضعیت',
            },
            Login:{
                Header: 'خوش آمدید',
                Message: 'برای ادامه لطفا وارد شوید.',
            },
            Register:{
                Header: 'خوش آمدید',
                Message: 'برای ادامه لطفا ثبت نام کنید.',
            },
            Placeholder: {
                Name: 'نام را وارد کنید',
                Email: 'ایمیل وارد کنید',
                Password: 'پسورد وارد کنید',
                ConfirmPassword: 'تایید پسورد',
            },
            AlreadyRegistered: 'قبلا ثبت نام کرده اید؟',
            Email: 'ایمیل',
            Password: 'پسورد',
            ConfirmPassword: 'تایید پسورد',
            RememberMe: 'مرا به خاطر بسپار',
            ForgotPassword: 'فراموشی رمز عبور',
            SignIn: 'ورود',
            SignUp: 'ثبت نام',
            SignOut: 'خروج',
            NewMember: 'کاربر جدید',
            Dashboard: 'داشبورد',
            Books: 'کتاب ها',
            Book: 'کتاب',
            Writers: 'نویسندگان',
            Writer: 'نویسنده',
            Publishers: 'ناشران',
            Publisher: 'ناشر',
            Translators: 'مترجمان',
            Translator: 'مترجم',
            Magazines: 'مجلات',
            Special_Issues: 'ویژه نامه ها',
            Images: 'تصاویر',
            Audios: 'صوت ها',
            PDFs: 'پی دی اف ها',
            New: 'جدید',
            Delete: 'حذف',
            Export: 'خروجی',
            Manage: 'مدیریت',
            Search: 'جست و جو',
            Code: 'کد',
            Name: 'نام',
            Image: 'تصویر',
            Price: 'قیمت',
            Category: 'دسته بندی',
            Reviews: 'امتیاز',
            Status: 'وضعیت',
            Slug: 'شناسه',
            Details: 'جزئیات',
            Add: 'افزودن',
            Edit: 'ویرایش',
            BookImage: 'تصویر کتاب',
            WriterImage: 'تصویر نویسنده',
            PublisherImage: 'تصویر ناشر',
            TranslatorImage: 'تصویر مترجم',
            MagazineImage: 'تصویر مجله',
            SpecialIssueImage: 'تصویر ویژه نامه',
            InventoryStatus: 'وضعیت موجودی',
            Quantity: 'موجودی',
            Tags: 'برچسب ها',
            Confirm: 'تایید',
            Yes: 'بله',
            No: 'خیر',
            Cancel: 'انصراف',
            Save: 'ذخیره',
            For: 'برای',
        }
    },
})

export default i18n;
