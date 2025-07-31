import { AppLayout } from '@/components/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Client {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    phone: string | null;
    status: string;
    outstanding_balance: number;
    created_at: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationMeta {
    current_page: number;
    from: number | null;
    to: number | null;
    total: number;
}

interface Props {
    clients: {
        data: Client[];
        links: PaginationLink[];
        meta: PaginationMeta;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Clients',
        href: '/clients',
    },
];

export default function ClientsIndex({ clients }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        }).format(amount);
    };

    const getStatusColor = (status: string) => {
        switch (status.toLowerCase()) {
            case 'active':
                return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            case 'inactive':
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
            case 'follow-up':
                return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Clients - Monsey Fitness" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <span className="mr-2">👥</span>
                            Clients
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Manage your fitness clients and their profiles
                        </p>
                    </div>
                    <Link
                        href="/clients/create"
                        className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center"
                    >
                        <span className="mr-2">➕</span>
                        Add Client
                    </Link>
                </div>

                {/* Clients Table */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead className="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Client
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Balance
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Joined
                                    </th>
                                    <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                {clients.data.length > 0 ? (
                                    clients.data.map((client) => (
                                        <tr key={client.id} className="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="flex items-center">
                                                    <div className="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center dark:bg-blue-900">
                                                        <span className="text-blue-600 font-semibold dark:text-blue-300">
                                                            {client.first_name.charAt(0)}{client.last_name.charAt(0)}
                                                        </span>
                                                    </div>
                                                    <div className="ml-4">
                                                        <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                            {client.first_name} {client.last_name}
                                                        </div>
                                                        <div className="text-sm text-gray-500 dark:text-gray-400">
                                                            ID: {client.id}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm text-gray-900 dark:text-white">{client.email}</div>
                                                {client.phone && (
                                                    <div className="text-sm text-gray-500 dark:text-gray-400">{client.phone}</div>
                                                )}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(client.status)}`}>
                                                    {client.status}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm">
                                                {client.outstanding_balance > 0 ? (
                                                    <span className="text-red-600 dark:text-red-400 font-medium">
                                                        {formatCurrency(client.outstanding_balance)}
                                                    </span>
                                                ) : (
                                                    <span className="text-green-600 dark:text-green-400">
                                                        Paid up
                                                    </span>
                                                )}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {new Date(client.created_at).toLocaleDateString()}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div className="flex items-center justify-end space-x-2">
                                                    <Link
                                                        href={`/clients/${client.id}`}
                                                        className="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                                    >
                                                        View
                                                    </Link>
                                                    <Link
                                                        href={`/clients/${client.id}/edit`}
                                                        className="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                    >
                                                        Edit
                                                    </Link>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan={6} className="px-6 py-12 text-center">
                                            <div className="text-gray-500 dark:text-gray-400">
                                                <span className="text-4xl mb-4 block">👤</span>
                                                <p className="text-lg font-medium mb-2">No clients found</p>
                                                <p className="text-sm">Get started by adding your first client.</p>
                                                <Link
                                                    href="/clients/create"
                                                    className="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                                                >
                                                    <span className="mr-2">➕</span>
                                                    Add Client
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {clients.data.length > 0 && clients.links && (
                        <div className="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                            <div className="flex items-center justify-between">
                                <div className="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <p>
                                        Showing <span className="font-medium">{clients.meta.from || 0}</span> to{' '}
                                        <span className="font-medium">{clients.meta.to || 0}</span> of{' '}
                                        <span className="font-medium">{clients.meta.total || 0}</span> results
                                    </p>
                                </div>
                                <div className="flex space-x-2">
                                    {clients.links.map((link, index: number) => (
                                        <span key={index}>
                                            {link.url ? (
                                                <Link
                                                    href={link.url}
                                                    className={`px-3 py-2 text-sm rounded-md transition-colors ${
                                                        link.active
                                                            ? 'bg-blue-600 text-white'
                                                            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'
                                                    }`}
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            ) : (
                                                <span
                                                    className="px-3 py-2 text-sm text-gray-400 dark:text-gray-600"
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            )}
                                        </span>
                                    ))}
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}