import { AppLayout } from '@/components/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

interface Stats {
    total_clients: number;
    active_clients: number;
    total_trainers: number;
    active_trainers: number;
    todays_sessions: number;
    upcoming_sessions: number;
    total_revenue: number;
    outstanding_balance: number;
}

interface RecentSession {
    id: number;
    title: string;
    scheduled_at: string;
    client: {
        first_name: string;
        last_name: string;
    };
    trainer: {
        first_name: string;
        last_name: string;
    };
    status: string;
}

interface RecentPayment {
    id: number;
    amount: number;
    type: string;
    method: string;
    processed_at: string;
    client: {
        first_name: string;
        last_name: string;
    };
}

interface RecentClient {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    status: string;
    created_at: string;
}

interface Props {
    stats: Stats;
    recent_sessions: RecentSession[];
    recent_payments: RecentPayment[];
    recent_clients: RecentClient[];
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ stats, recent_sessions, recent_payments, recent_clients }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        }).format(amount);
    };

    const formatDate = (date: string) => {
        return new Date(date).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });
    };

    const getStatusColor = (status: string) => {
        switch (status.toLowerCase()) {
            case 'active':
                return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            case 'inactive':
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
            case 'follow-up':
                return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
            case 'scheduled':
                return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
            case 'completed':
                return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard - Monsey Fitness" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            💪 Monsey Fitness Dashboard
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Welcome back! Here's what's happening with your fitness business today.
                        </p>
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="p-2 bg-blue-100 rounded-lg dark:bg-blue-900">
                                <span className="text-2xl">👥</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Clients</p>
                                <p className="text-2xl font-semibold text-gray-900 dark:text-white">{stats.total_clients}</p>
                                <p className="text-xs text-green-600 dark:text-green-400">
                                    {stats.active_clients} active
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="p-2 bg-green-100 rounded-lg dark:bg-green-900">
                                <span className="text-2xl">🏃‍♂️</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Trainers</p>
                                <p className="text-2xl font-semibold text-gray-900 dark:text-white">{stats.total_trainers}</p>
                                <p className="text-xs text-green-600 dark:text-green-400">
                                    {stats.active_trainers} active
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="p-2 bg-purple-100 rounded-lg dark:bg-purple-900">
                                <span className="text-2xl">📅</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Today's Sessions</p>
                                <p className="text-2xl font-semibold text-gray-900 dark:text-white">{stats.todays_sessions}</p>
                                <p className="text-xs text-blue-600 dark:text-blue-400">
                                    {stats.upcoming_sessions} upcoming
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="p-2 bg-yellow-100 rounded-lg dark:bg-yellow-900">
                                <span className="text-2xl">💰</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Revenue</p>
                                <p className="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {formatCurrency(stats.total_revenue)}
                                </p>
                                <p className="text-xs text-red-600 dark:text-red-400">
                                    {formatCurrency(stats.outstanding_balance)} outstanding
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Recent Activity Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {/* Recent Sessions */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <span className="mr-2">📅</span>
                                Upcoming Sessions
                            </h3>
                        </div>
                        <div className="p-6">
                            {recent_sessions.length > 0 ? (
                                <div className="space-y-4">
                                    {recent_sessions.map((session) => (
                                        <div key={session.id} className="flex items-center justify-between">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {session.title}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {session.client.first_name} {session.client.last_name} • {session.trainer.first_name} {session.trainer.last_name}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {formatDate(session.scheduled_at)}
                                                </p>
                                            </div>
                                            <span className={`px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(session.status)}`}>
                                                {session.status}
                                            </span>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                    No upcoming sessions
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Recent Payments */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <span className="mr-2">💳</span>
                                Recent Payments
                            </h3>
                        </div>
                        <div className="p-6">
                            {recent_payments.length > 0 ? (
                                <div className="space-y-4">
                                    {recent_payments.map((payment) => (
                                        <div key={payment.id} className="flex items-center justify-between">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {formatCurrency(payment.amount)}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {payment.client.first_name} {payment.client.last_name}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {payment.type} • {formatDate(payment.processed_at)}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                    {payment.method}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                    No recent payments
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Recent Clients */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <span className="mr-2">👤</span>
                                New Clients
                            </h3>
                        </div>
                        <div className="p-6">
                            {recent_clients.length > 0 ? (
                                <div className="space-y-4">
                                    {recent_clients.map((client) => (
                                        <div key={client.id} className="flex items-center justify-between">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {client.first_name} {client.last_name}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {client.email}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    Joined {formatDate(client.created_at)}
                                                </p>
                                            </div>
                                            <span className={`px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(client.status)}`}>
                                                {client.status}
                                            </span>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                    No new clients
                                </p>
                            )}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <span className="mr-2">⚡</span>
                        Quick Actions
                    </h3>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a
                            href="/clients/create"
                            className="p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                        >
                            <div className="text-2xl mb-2">👤</div>
                            <p className="text-sm font-medium text-gray-900 dark:text-white">Add Client</p>
                        </a>
                        <a
                            href="/sessions/create"
                            className="p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors"
                        >
                            <div className="text-2xl mb-2">📅</div>
                            <p className="text-sm font-medium text-gray-900 dark:text-white">Book Session</p>
                        </a>
                        <a
                            href="/payments/create"
                            className="p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors"
                        >
                            <div className="text-2xl mb-2">💳</div>
                            <p className="text-sm font-medium text-gray-900 dark:text-white">Record Payment</p>
                        </a>
                        <a
                            href="/reports"
                            className="p-4 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors"
                        >
                            <div className="text-2xl mb-2">📊</div>
                            <p className="text-sm font-medium text-gray-900 dark:text-white">View Reports</p>
                        </a>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}