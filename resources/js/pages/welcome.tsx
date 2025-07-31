import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Monsey Fitness - Admin Platform">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="w-full bg-white/80 backdrop-blur-md border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-6">
                            <div className="flex items-center space-x-3">
                                <div className="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-lg">💪</span>
                                </div>
                                <h1 className="text-2xl font-bold text-gray-900 dark:text-white">Monsey Fitness</h1>
                            </div>
                            <nav className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                    >
                                        Go to Dashboard
                                    </Link>
                                ) : (
                                    <div className="flex space-x-3">
                                        <Link
                                            href={route('login')}
                                            className="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg font-medium transition-colors dark:text-gray-300 dark:hover:text-blue-400"
                                        >
                                            Login
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                        >
                                            Get Started
                                        </Link>
                                    </div>
                                )}
                            </nav>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                    <div className="text-center">
                        <h1 className="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                            🏋️‍♀️ Complete Fitness Business Management
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-12 max-w-3xl mx-auto">
                            Streamline your fitness business with our comprehensive admin platform. 
                            Manage clients, trainers, sessions, and payments all in one place.
                        </p>
                        
                        {!auth.user && (
                            <div className="flex justify-center space-x-4 mb-16">
                                <Link
                                    href={route('register')}
                                    className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all transform hover:scale-105 shadow-lg"
                                >
                                    Start Free Trial
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="bg-white hover:bg-gray-50 text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold transition-all border-2 border-blue-600 shadow-lg"
                                >
                                    Sign In
                                </Link>
                            </div>
                        )}
                    </div>

                    {/* Features Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                        <div className="bg-white rounded-xl p-8 shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">👥</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Client Management</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Complete client profiles with status tracking (Active, Inactive, Follow-Up), 
                contact info, medical notes, and membership history.
                            </p>
                        </div>

                        <div className="bg-white rounded-xl p-8 shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">🏃‍♂️</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Trainer Scheduling</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Manage trainer profiles, schedules, specialties, and commission tracking. 
                Handle both personal training and group classes.
                            </p>
                        </div>

                        <div className="bg-white rounded-xl p-8 shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div className="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📅</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Session Booking</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Intuitive calendar interface with drag-and-drop functionality for booking 
                and rescheduling sessions. Track attendance automatically.
                            </p>
                        </div>

                        <div className="bg-white rounded-xl p-8 shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div className="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">💳</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Payment Processing</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Integrated payment gateway support (Cardknox/Sola). Handle memberships, 
                packages, outstanding balances, and recurring billing.
                            </p>
                        </div>

                        <div className="bg-white rounded-xl p-8 shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div className="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📊</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Analytics Dashboard</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Real-time insights on revenue, client activity, trainer performance, 
                and business metrics to help you make informed decisions.
                            </p>
                        </div>

                        <div className="bg-white rounded-xl p-8 shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <div className="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📱</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Mobile Friendly</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Fully responsive design that works perfectly on desktop, tablet, and mobile. 
                Manage your fitness business from anywhere.
                            </p>
                        </div>
                    </div>

                    {/* Dashboard Preview */}
                    <div className="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <div className="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                            <h2 className="text-2xl font-bold text-white mb-2">Admin Dashboard Preview</h2>
                            <p className="text-blue-100">Get a glimpse of your fitness business command center</p>
                        </div>
                        <div className="p-8">
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-blue-600 mb-1">247</div>
                                    <div className="text-gray-600 text-sm">Active Clients</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-green-600 mb-1">12</div>
                                    <div className="text-gray-600 text-sm">Trainers</div>
                                </div>
                                <div className="text-3xl font-bold text-purple-600 mb-1 text-center">
                                    <div>18</div>
                                    <div className="text-gray-600 text-sm">Today's Sessions</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-yellow-600 mb-1">$12,480</div>
                                    <div className="text-gray-600 text-sm">Monthly Revenue</div>
                                </div>
                            </div>
                            <div className="bg-gray-50 rounded-lg p-6 dark:bg-gray-700">
                                <div className="flex items-center justify-center text-gray-500 dark:text-gray-400">
                                    <span className="text-6xl mr-4">📈</span>
                                    <div>
                                        <div className="text-lg font-semibold">Interactive Charts & Reports</div>
                                        <div className="text-sm">Track revenue, attendance, and growth metrics</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* CTA Section */}
                    {!auth.user && (
                        <div className="text-center mt-20">
                            <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                Ready to Transform Your Fitness Business?
                            </h2>
                            <p className="text-xl text-gray-600 dark:text-gray-300 mb-8">
                                Join hundreds of fitness professionals who trust Monsey Fitness
                            </p>
                            <Link
                                href={route('register')}
                                className="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-12 py-4 rounded-lg text-xl font-semibold transition-all transform hover:scale-105 shadow-xl"
                            >
                                Start Your Free Trial Today 🚀
                            </Link>
                        </div>
                    )}
                </main>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <div className="flex items-center justify-center space-x-3 mb-4">
                            <div className="w-8 h-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold">💪</span>
                            </div>
                            <span className="text-xl font-bold">Monsey Fitness</span>
                        </div>
                        <p className="text-gray-400 mb-4">
                            Professional fitness business management made simple
                        </p>
                        <p className="text-sm text-gray-500">
                            Built with ❤️ by{" "}
                            <a 
                                href="https://app.build" 
                                target="_blank" 
                                className="text-blue-400 hover:text-blue-300 transition-colors"
                            >
                                app.build
                            </a>
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}